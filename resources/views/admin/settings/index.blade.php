@extends('layouts.app')


@section('content')
<section class="content pdall0-xs pt10-xs">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li>
                <a href="javascript:;">
                    <span style="font-weight: bold;">通用设置</span>
                </a>
            </li>
            <li class="active">
                <a href="#tab_1" data-toggle="tab">系统设置</a>
            </li>
            
        {{--     <li>
                <a href="#tab_2" data-toggle="tab">小屋设置</a>
            </li> --}}

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form1">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">系统名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" maxlength="60" placeholder="系统名称" value="{{ getSettingValueByKey('name') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="col-sm-3 control-label">系统LOGO</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="image1" name="logo" placeholder="系统LOGO" value="{{ getSettingValueByKey('logo') }}">
                                    <div class="input-append">
                                        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image1')">选择图片</a>
                                        <img src="@if(getSettingValueByKey('logo')) {{ getSettingValueByKey('logo') }} @endif" style="max-width: 100%; max-height: 150px; display: block;"></div>
                                    <p class="help-block">默认系统首页LOGO,通用头部显示，最佳显示尺寸为240*60像素</p>
                                </div>
                            </div>
              
                             <div class="form-group">
                                <label for="agt" class="col-sm-3 control-label">当前智慧中心agt</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="agt" maxlength="60" placeholder="当前智慧中心agt(设备添加控制的时候必须的参数)" value="{{ getSettingValueByKey('agt') }}"></div>
                            </div>

                        </form>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(1)">保存</button>
                    </div>
                    <!-- /.box-footer --> </div>
            </div>

            <!-- /.tab-pane -->

            <div class="tab-pane" id="tab_2">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form2">
                   

                       {{--      <div class="form-inline">
                                <label for="feie_sn" class="col-sm-3 control-label">距离结束时间</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="house_end_time" placeholder="不填默认是1天" value="{{ getSettingValueByKey('house_end_time') }}">天</div>
                            </div> --}}

            
                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(2)">保存</button>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.tab-content --> </div>
</section>
@endsection

@include('admin.partial.imagemodel')

@section('scripts')
<script>
        function saveForm(index){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/smart/settings/setting",
                type:"POST",
                data:$("#form"+index).serialize(),
                success: function(data) {
                  if (data.code == 0) {
                    layer.msg(data.message, {icon: 1});
                  }else{
                    layer.msg(data.message, {icon: 5});
                  }
                },
                error: function(data) {
                  //提示失败消息

                },
            });  
        }

       function openMap(type=''){
            var name =type==''?'detail':'address';
            var address=$('input[name='+name+']').val();
            var url="/smart/settings/map?address="+address;
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
            $('input[name=detail],input[name=address]').val(address);
            $('input[name=lat]').val(weidu);
            $('input[name=lon]').val(jindu);
            layer.closeAll();
        }

        $('#kecheng_list').keypress(function(e) { 
           var rows=parseInt($(this).attr('rows'));
            // 回车键事件  
           if(e.which == 13) {  
                rows +=1;
           }  
           $(this).attr('rows',rows);
      });
    </script>
@endsection