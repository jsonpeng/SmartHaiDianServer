var ECharts_main_option = {
    grid:{
        left:'15%',
        top:10,
        right:'9%',
        bottom:30
    },
    xAxis:{
        type: 'value',
        splitLine: {
            show: true,
            interval:0,
            lineStyle:{
                type: 'dotted',
                color:'#646464',
            }
        },
        nameGap:0,
        axisLine:{
            show:true,
            onZero: false,
        },
        axisLabel:{
            show:true,
            interval:0,
            formatter:function (value,index) {
                var date = new Date(value);
                date = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                return date;
            },
            color:'#acacac',
            fontSize:10,
        },
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%'],
        min: function(value) {
            return value.min - 50;
        },
        max: function(value) {
            return value.max + 50;
        },
        splitLine: {
            show: true,
            lineStyle:{
                type: 'dotted',
                color:'#646464',
            }
        },
        axisLabel:{
            fontSize:10,
            color:'#acacac'
        },
        axisPointer:{
            id:'yPointer',
            show: false,
            lineStyle:{
                color: 'rgb(255, 255, 255)',
                width:2,
                type:'dotted'
            },
            label: {
                show:false
            },
            handle :{
                show:true,
                size:0
            },
            status:'show',
        }
    },
    point:{
        symbol:'circle',
        silent:true, //不响应和触发鼠标事件
        symbolSize:8,
        symbolOffset: [0,0],
        label:{
            show:true,
            color:'rgb(255,255,255)',
            position:['-50%','-200%'],
        },
    },
    anchorPoint:{
        symbol:'pin',
        symbolSize:30,
        symbolOffset:[0,'-10%'],
        value:'涨',
        // x:'80%',
        itemStyle:{

        },
        label:{
            show:true,
            color:'rgb(255,255,255)',
        }
    },
    baseLine:[
        {
            symbolSize:5,
            xAxis: 'min',
            lineStyle:{
                color:'white',
            },
            yAxis: 0
        },
        {
            symbol:'pin',
            symbolSize:10,
            symbolOffset:['200%',0],
            xAxis: 'max',
            yAxis: 0
        },
    ],
    redLine:[
        {
            symbolSize:5,
            xAxis: 'min',
            lineStyle:{
                color:'red',
            },
            yAxis: 0
        },
        {
            symbol:'pin',
            symbolSize:10,
            xAxis: 'max',
            yAxis: 0
        },
    ],
    greenLine:[
        {
            symbolSize:5,
            xAxis: 'min',
            lineStyle:{
                color:'green',
            },
            yAxis: 0
        },
        {
            symbol:'pin',
            symbolSize:10,
            xAxis: 'max',
            yAxis: 0
        },
    ],
    chart: {
        id: 'lineSeries',
        name: '行情数据',
        type: 'line',
        showSymbol: false,
        hoverAnimation: false,
        lineStyle:{
            color:'rgb(255,255,255)',
            width:1
        },
        data: [],
    },
    pointColor :{
        type: 'radial',
        x: 0.5,
        y: 0.5,
        r: 0.5,
        colorStops: [{
            offset: 0, color: 'rgba(255,255,255,0)' // 0% 处的颜色
        }, {
            offset: 1, color: 'red' // 100% 处的颜色
        }],
    }
}