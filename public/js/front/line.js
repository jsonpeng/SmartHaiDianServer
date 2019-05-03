var value; //临时值
const RISE = 1; //涨线
const DOWN = 2; //跌线
const BASE = 0; //基础线

// 当前的坐标值数组[xAxis,yAxis]
//currentAxis[0] 当前时间 单位毫秒
//currentAxis[1] 当前价位
var currentAxis;
// x轴旧值
var oldXAxis;
//x轴最小、最大值
var minXAxis = null,maxXAxis = null;
//当前时间戳 (单位:毫秒)
var currentTS;
//标记线数组、标记点数组
var lineArr = [], pointArr = [];
//步长 1秒
var step = 1000;
//图表对象
var myChart;
//图表数据数组
var data = [];
//stomp客户端对象
var stompClient;
// 偏移量
var offset_value = 0;
// 买入方向 1涨 2跌
var trade_orientation = 1;
var host =  "https://btc.chicheng001.top";
// 存储临时偏移
var offset_tmp = 0;
// 使用应用偏移
var use_offset = 0;

//是否链接
var isConnect = false;
//是否有购买操作
var buy_condition = 0;
//买入指数
var index_begin=0;
/**
 * 连接websocket
 */


function connect() {
    var socket = new SockJS(host +"/api/portfolio");
    stompClient = Stomp.over(socket);
    // alert(112);
    stompClient.connect({}, function(frame) {
        isConnect = true;
        stompClient.subscribe('/topic/coord', function(respnose){

            var coord = JSON.parse(respnose.body);

            offset_tmp = getOffset();

            var curY = coord.yAxis + offset_tmp;
            // if(index_begin){
            //     curY = index_begin + offset_tmp;
            //     return;
            // }
            var arr = [coord.xAxis,curY];
            if (buy_condition && minXAxis) {
                use_offset = 1;
                // alert(coord.yAxis)
                // alert('yAxis:'+coord.yAxis)
                // alert('curY:'+curY)
                // alert('index_begin:'+index_begin)
                arr = [coord.xAxis,index_begin]
                if (trade_orientation == 1) {
                    addMarkLine(RISE,minXAxis,maxXAxis,index_begin);
                    addMarkPoint(RISE);
                    myChart.setOption({
                        series:[getMarkOption()]
                    });
                } else {
                    addMarkLine(DOWN,minXAxis,maxXAxis,index_begin);
                    addMarkPoint(DOWN);
                    myChart.setOption({
                        series:[getMarkOption()]
                    });
                }
                buy_condition = 0;

                
            }

            // *
            //  * 如果myChart为空,则先初始化
            //  * 初始化图表务必要放在ws连接成功之后
            //  * 不然会有显示异常
             
            if(!data.length){
                requestChartData();
            }else
                dynamicChart(arr);
        });

    });
    
    /**
     * 监听是否断开连接
     */
    socket.onclose = function() {
        
        disConnect();
        setTimeout(reConnect(), 500);
            
        // mychart=null;
        // reConnect();
        // api.alert({ msg: '连接中断，请查看当前网络状态或退出重新进入' });
    };
}

/**
 * 请求折线图初始化数据
 */
function requestChartData() {
    $.ajax({
        type:'GET',
        url: host + '/api/trade/coords',
        success: function (json) {
            var code = json.code;
            if(code == 0){
                var arr = json.data;
                for(var i = 0; i < arr.length; i++){
                    var coord = arr[i];
                    data.push([coord.xAxis,coord.yAxis]);
                }
                minXAxis = data[0][0];
                maxXAxis = data[data.length-1][0] + (300 - data.length) * step;
                //获取当前坐标对象
                currentAxis = data[data.length-1];
                
                setTimeout(initChart(),1000)
            }
        }
    });
}
/**
 * 初始化图表
 */
function initChart(){
    // 基于准备好的dom，初始化echarts实例
    myChart = echarts.init(document.getElementById('root'));
    var chart = ECharts_main_option.chart;
    var xAxis = ECharts_main_option.xAxis;
    var yAxis = ECharts_main_option.yAxis;
    var grid=ECharts_main_option.grid;
    $.extend(xAxis,{ max: minXAxis, min:maxXAxis });
    chart.data = data;
    var option = {
        grid:grid,
        xAxis: xAxis,
        yAxis: yAxis,
        series: [chart],
    }
    myChart.setOption(option);
}


function getOffset(){
    var shift = 0;
    if (offset_value > 0 && use_offset) {
        offset_value -= 0.5;
        if (trade_orientation == 1) {
            shift = offset_value;
        } else {
            shift = -offset_value;
        }
        offset_tmp = shift;
    }
    return shift;
}

/**
 * 动态更新图表
 * @param arr
 */
function dynamicChart(arr) {
    currentAxis = arr;
    data.push(arr);
    //基础锚点
    var point = ECharts_main_option.point;
    point.xAxis = currentAxis[0];
    point.yAxis = currentAxis[1];
    //保留两位小数
    point.value = Math.floor(currentAxis[1] * 100) / 100;
    //判断偏
    point.value += offset_tmp;

    point.itemStyle= { color: ECharts_main_option.pointColor };

    var op = {}

    if(currentAxis[0] >= maxXAxis){
        point.xAxis = maxXAxis;
        //重新计算 x轴 最小、最大值
        minXAxis += 30 * step;
        maxXAxis += 30 * step;
        for(var i = 0; i< 30; i++)
            data.shift();
        $.extend(op,{
            xAxis:{
                max: minXAxis,
                min: maxXAxis,
            }
        });
    }
    if(pointArr.length > 1){
        pointArr[1] = point;
    }else if(pointArr.length <= 1){
        pointArr = [point];
    }
    var baseLine = getMarkLine(BASE,minXAxis,maxXAxis,currentAxis[1]);
    if(lineArr.length > 1){
        lineArr[1] = baseLine
        lineArr[0][0].xAxis = minXAxis;
        lineArr[0][1].xAxis = maxXAxis;
    } if(lineArr.length <= 1)
        lineArr= [baseLine];

    var tmp = getMarkOption();
    $.extend(tmp,{ data: data });
    $.extend(op,{ series:[tmp] });

    myChart.setOption(op);
}

/***
 * 绑定点击事件
 */
function bind() {

    $('.btn-down').click(doBuyDown);

    $('.btn-up').click(doBuyRise);

    $('.btn-cancel').click(cancelMark);
    $('.disconnect').click(function () {
        if(isConnect){
            stompClient.disconnect(function () {
               isConnect = false;
                data = [];
            });
        }
    });

    $('.connect').click(function () {
        if(stompClient && !isConnect){
            connect();
        }
    });
}
function disConnect(){
    if(isConnect){
        stompClient.disconnect(function () {
           isConnect = false;
            data = [];
        });
    }
}
function reConnect(){
    if(stompClient && !isConnect){
        connect();
    }
}

/**
 * 响应买涨按钮
 */

function doBuyRise() {
    trade_orientation=1;
    buy_condition = 1;
}
/**
 * 响应买跌按钮
 */

function doBuyDown(data) {
    trade_orientation=2;
    buy_condition = 1;
}
/**
 * 响应取消按钮
 */
function cancelMark() {
    //删除线
    if(lineArr.length > 1) lineArr.shift();
    //删除点
    if(pointArr.length > 1) pointArr.shift();

    use_offset = 0;
}

function getMarkOption(){
    return {
        markPoint: {
            silent:true,//不响应和触发鼠标事件
            animation:false,
            data: pointArr,
        },
        markLine:{
            silent:true,//不响应和触发鼠标事件
            animation:false,
            data:lineArr,
        }
    }
}

function addMarkLine(type,start,end,value) {
    var line = getMarkLine(type,start,end,value);
    if(lineArr.length > 1){
        lineArr[0] = line;
    }else if(lineArr.length <= 1){
        lineArr.unshift(line);
    }
}

function addMarkPoint(type) {
    var anchorPoint = ECharts_main_option.anchorPoint;

    if(type == RISE){
        anchorPoint.value = '涨';
        anchorPoint.itemStyle.color = 'red';
    }else if(type == DOWN){
        anchorPoint.value = '跌';
        anchorPoint.itemStyle.color = 'green';
    }
    anchorPoint.xAxis = currentAxis[0];
    //anchorPoint.yAxis = currentAxis[1] + offset_tmp;
    anchorPoint.yAxis = index_begin;
    if(pointArr.length > 1){
        pointArr[0] = anchorPoint;
    }else if(pointArr.length <= 1){
        pointArr.unshift(anchorPoint);
    }
}

function getMarkLine(type,start,end, value) {
    var line = null;
    switch (type) {
        case RISE:
            line = ECharts_main_option.redLine;
            break;
        case DOWN:
            line  = ECharts_main_option.greenLine;
            break;
        default:
            line  = ECharts_main_option.baseLine;
            break;
    }
    var sp = line[0]; // 起点对象
    var ep = line[1];  // 终点对象
    sp.xAxis = start;
    ep.xAxis = end;
    sp.yAxis = ep.yAxis = value;
    return line;
}


$(document).ready(function () {
    setTimeout(function(){
        initChart();
        connect();
    }, 500);
    
    // bind();
});