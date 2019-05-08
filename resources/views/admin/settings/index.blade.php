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
            
            <li>
                <a href="#tab_2" data-toggle="tab">环境参数设置</a>
            </li> 

            <li>
                <a href="#tab_3" data-toggle="tab">能量参数设置</a>
            </li>

            <li>
                <a href="#tab_4" data-toggle="tab">设备参数设置</a>
            </li>  

            <li>
                <a href="#tab_5" data-toggle="tab">环境idx参数设置</a>
            </li>  

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form1">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">系统名称</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" maxlength="60" placeholder="系统名称" value="{{ getSettingValueByKey('name') }}"></div>
                            </div>

                     <!--        <div class="form-group">
                                <label for="logo" class="col-sm-3 control-label">系统LOGO</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="image1" name="logo" placeholder="系统LOGO" value="{{ getSettingValueByKey('logo') }}">
                                    <div class="input-append">
                                        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image1')">选择图片</a>
                                        <img src="@if(getSettingValueByKey('logo')) {{ getSettingValueByKey('logo') }} @endif" style="max-width: 100%; max-height: 150px; display: block;"></div>
                                    <p class="help-block">默认系统首页LOGO,通用头部显示，最佳显示尺寸为240*60像素</p>
                                </div>
                            </div> -->
              
                             <div class="form-group">
                                <label for="agt" class="col-sm-3 control-label">当前智慧中心agt(注:不要轻易修改!)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="agt" maxlength="60"  placeholder="当前智慧中心agt(设备添加控制的时候必须的参数)" value="{{ getSettingValueByKey('agt') }}"></div>
                            </div>

                              <div class="form-group">
                                <label for="agt" class="col-sm-3 control-label">java服务接口地址(注:不要轻易修改!)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="java_request_url" maxlength="60"   placeholder="java服务接口地址" value="{{ getSettingValueByKey('java_request_url') }}"></div>
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
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">光照指数</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_gz" maxlength="60" placeholder="光照指数" value="{{ getSettingValueByKey('env_gz') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">体感温度
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_tg" maxlength="60" placeholder="体感温度" value="{{ getSettingValueByKey('env_tg') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">声环境指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_sy" maxlength="60" placeholder="声环境指数
" value="{{ getSettingValueByKey('env_sy') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">紫外线指数</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_zwx" maxlength="60" placeholder="紫外线指数" value="{{ getSettingValueByKey('env_zwx') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">空气质量
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_kq" maxlength="60" placeholder="空气质量" value="{{ getSettingValueByKey('env_kq') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">穿衣指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="env_cy" maxlength="60" placeholder="穿衣指数" value="{{ getSettingValueByKey('env_cy') }}"></div>
                            </div>

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

              <div class="tab-pane" id="tab_3">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form3">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">C02减排量
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="co2" maxlength="60" placeholder="C02减排量
" value="{{ getSettingValueByKey('co2') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">节约煤碳量
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mt" maxlength="60" placeholder="节约煤碳量
" value="{{ getSettingValueByKey('mt') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">减少树木砍伐量

</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="tree" maxlength="60" placeholder="减少树木砍伐量" value="{{ getSettingValueByKey('tree') }}"></div>
                            </div>

                       

                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(3)">保存</button>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab_4">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form4">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">物业
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_wy" maxlength="60" placeholder="物业
" value="{{ getSettingValueByKey('dev_wy') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">厂商

</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_cs" maxlength="60" placeholder="厂商
" value="{{ getSettingValueByKey('dev_cs') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">维修

</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_wx" maxlength="60" placeholder="维修" value="{{ getSettingValueByKey('dev_wx') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">保养
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_by" maxlength="60" placeholder="保养" value="{{ getSettingValueByKey('dev_by') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">运行
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_yy" maxlength="60" placeholder="运行" value="{{ getSettingValueByKey('dev_yy') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">告警
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="dev_gj" maxlength="60" placeholder="告警" value="{{ getSettingValueByKey('dev_gj') }}"></div>
                            </div>
            
                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(4)">保存</button>
                    </div>
                </div>
            </div>

                  <div class="tab-pane" id="tab_5">
                <div class="box box-info form">
                    <!-- form start -->
                    <div class="box-body">
                        <form class="form-horizontal" id="form5">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">洗车指数</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_xc" maxlength="60" placeholder="物业
" value="{{ getSettingValueByKey('idx_xc') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">污染指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_wr" maxlength="60" placeholder="污染指数" value="{{ getSettingValueByKey('idx_wr') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">紫外线指数

</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_zwx" maxlength="60" placeholder="紫外线指数" value="{{ getSettingValueByKey('idx_zwx') }}"></div>
                            </div>

                           <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">穿衣指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_cy" maxlength="60" placeholder="穿衣指数" value="{{ getSettingValueByKey('idx_cy') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">舒适度
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_shd" maxlength="60" placeholder="舒适度" value="{{ getSettingValueByKey('idx_shd') }}"></div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">阵雨指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_zy" maxlength="60" placeholder="阵雨指数" value="{{ getSettingValueByKey('idx_zy') }}"></div>
                            </div>

                               <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">感冒指数
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_gm" maxlength="60" placeholder="感冒指数" value="{{ getSettingValueByKey('idx_gm') }}"></div>
                            </div>

                                    <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">晾晒指数</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="idx_ls" maxlength="60" placeholder="晾晒指数" value="{{ getSettingValueByKey('idx_ls') }}"></div>
                            </div>
            
                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(5)">保存</button>
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