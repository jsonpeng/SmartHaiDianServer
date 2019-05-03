<script type="text/javascript" src="{{ asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datepicke/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datepicke/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
    selector: 'textarea.intro',
    height: 500,
    theme: 'modern',
    language: 'zh_CN',
    plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help responsivefilemanager'],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true,
    external_filemanager_path: "/filemanager/",
    filemanager_title: "图片",
    external_plugins: { "filemanager": "/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js" },
    templates: [{ title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' }],
    content_css: [
        //'//www.tinymce.com/css/codepen.min.css'
    ]
});
       $('#province').on('change', function(){
            var newParentID = $('#province').val();
             //$('#district').hide();
            if (newParentID == 0) {
                $('#city').empty();
                $('#city').append("<option value='0'>请选择城市</option>");
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/ajax/cities/getAjaxSelect/"+newParentID,
                type:"POST",
                success: function(data) {
                    if(data.code==0){
                    $('#city').empty();
                    $('#city').append("<option value='0'>请选择城市</option>");
                    $('#city').append(data.message);
                }else{
                    $('#city').empty();
                    $('#city').append("<option value='0'>请选择城市</option>");
                }
                },
                error: function(data) {
                  //提示失败消息
                    
                },
            });
        });

        $('#city').on('change', function(){
            var newParentID = $('#city').val();

            if (newParentID == 0) {
                $('#district').empty();
                $('#district').append("<option value='0'>请选择区域</option>");
                $('#district').show();
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/ajax/cities/getAjaxSelect/"+newParentID,
                type:"POST",
                success: function(data) {
                    if(data.code==0){
                    $('#district').empty();
                    $('#district').append("<option value='0'>请选择区域</option>");
                    $('#district').append(data.message);
                    $('#district').show();
                }else{
                    $('#district').empty();
                    $('#district').append("<option value='0'>请选择区域</option>");
                    $('#district').show();
                }
                   
                },
                error: function(data) {
                  //提示失败消息
                    
                },
            });
        });


        $('#district').change(function(){
            var detail=$('#province').find("option:selected").text()+$('#city').find("option:selected").text()+$(this).find("option:selected").text();
            var type=$(this).data('type');
            var name=type=="project"?'address':'detail';
            $('input[name='+name+']').val(detail);
            triggerAddressInput();
        });


        function openMap(type=''){
            var name =type==''?'detail':'address';
            var address=$('input[name='+name+']').val();
            var url="/map?address="+address;
                if($(window).width()<479){
                        layer.open({
                            type: 2,
                            title:'请选择详细地址',
                            shadeClose: true,
                            shade: 0.8,
                            area: ['100%', '100%'],
                            content: url, 
                        });
                }else{
                     layer.open({
                        type: 2,
                        title:'请选择详细地址',
                        shadeClose: true,
                        shade: 0.8,
                        area:['60%', '680px'],
                        content: url, 
                    });
                }
        }


        function call_back_by_map(address,jindu,weidu){
            //$('input[name=detail],input[name=address]').val(address);
            $('input[name=lat]').val(weidu);
            $('input[name=lon]').val(jindu);
            layer.closeAll();
        }

</script>

<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=usHzWa4rzd22DLO58GmUHUGTwgFrKyW5&s=1"></script>
<!--根据地址索引地图标点-->
<script type="text/javascript">
    $('input[name=address]').keyup(function(){
        var val = $(this).val();
        if(val != ''){
            controlMap(val);
        }
    });

    function triggerAddressInput(){
        $('input[name=address]').trigger('keyup');
    }
    
    function showInfo(e){
        myGeo.getLocation(e.point, function (rs) {
            var addComp = rs.addressComponents;
            var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;  
            if (confirm("确定选择地址是" + address + "?")) {
                 call_back_by_map(address,e.point.lng,e.point.lat);
            }
        });
        addMarker(e.point);
    }

    //地图上标注  
    function addMarker(point) {  
        var marker = new BMap.Marker(point);  
        markersArray.push(marker);  
        clearOverlays();  
        map.addOverlay(marker);  
    } 

    //清除标识  
    function clearOverlays() {  
        if (markersArray) {  
            for (i in markersArray) {  
                map.removeOverlay(markersArray[i])  
            }  
        }  
    }
    var myGeo;
    var map;
    // 百度地图API功能
    var markersArray = [];  
    function controlMap(address){ 
        map = new BMap.Map("allmap");
        map.setMapStyle({style:'normal'});
        //var point = new BMap.Point(114.329303,30.475501);
        //map.centerAndZoom(point,12);
        // 创建地址解析器实例
        myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint(address, function(point){
            if (point) {
                $('.map').show(500);
                map.centerAndZoom(point, 16);
                clearOverlays();
                map.addOverlay(new BMap.Marker(point));
                //map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
                //map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
               // map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
                map.enableScrollWheelZoom();  
                myGeo.getLocation(point, function (rs) {  
                var addComp = rs.addressComponents;  
                var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;  
               
                javascript:window.parent.call_back_by_map(null,point.lng,point.lat);
                 
            });                            //启用滚轮放大缩小
            }else{
                $('.map').hide(500);
                //alert("您选择地址没有解析到结果!");
            }
        });
        //map.addEventListener("click", showInfo); 
    }   
</script>
