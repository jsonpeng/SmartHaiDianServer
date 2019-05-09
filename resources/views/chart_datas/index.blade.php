@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">图表数据管理</h1>
        <a class="btn btn-primary import_topic" href="javascripts:;"><i class="glyphicon glyphicon-download"></i> 从excel中导入数据</a>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('chartDatas.create') !!}">添加</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
          <?php $tools = 1;?>
        <div class="box box-default box-solid mb10-xs @if(!$tools) collapsed-box @endif">
                        <div class="box-header with-border">
                          <h3 class="box-title">查询</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-{!! !$tools?'plus':'minus' !!}"></i></button>
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="order_search">
                               
                                <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <label for="shelf">指标类型</label>
                                    <select class="form-control" name="idx">
                                        <option value="" @if (!array_key_exists('idx', $input)) selected="selected" @endif>全部</option>
                                      @foreach($chartIdx as $key => $item)
                                        <option value="{!! $key !!}" @if(isset($input['idx']) && $input['idx'] == $key) selected="selected" @endif>{!! $item !!}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <label for="shelf">时间跨度</label>
                                    <select class="form-control" name="time_span">
                                        <option value="" @if (!array_key_exists('time_span', $input)) selected="selected" @endif>全部</option>
                                      @foreach($timeSpan as $key => $item)
                                        <option value="{!! $key !!}" @if(isset($input['time_span']) && $input['time_span'] == $key) selected="selected" @endif>{!! $item !!}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-1 col-md-1 hidden-xs hidden-sm" style="padding-top: 25px;">
                                    <button type="submit" class="btn btn-primary pull-right " >查询</button>
                                </div>
                                <div class="form-group col-lg-1 col-md-1 hidden-xs hidden-sm" style="padding-top: 25px;">
                                    <a href="{!! route('chartDatas.index') !!}" class="btn btn-primary pull-right " >重置</a>
                                </div>
                                <div class="form-group col-xs-6 visible-xs visible-sm" >
                                    <button type="submit" class="btn btn-primary pull-left " >查询</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('chart_datas.table')
            </div>
        </div>
        <div class="text-center">
            {!! $chartDatas->appends($input)->links() !!}
        </div>
    </div>


    <div id="import_box" style="display: none;">
    <div style='width:350px; padding: 0 15px;height: 100%;'>
        <form id="import_form" class="import_class">
            <div style='width:320px;padding: 0px 0px 0px 0px;' class='form-group has-feedback attach' style="">
                 <label>上传Excel文件:</label>
                 <div class="input-append type_files" style="">
                      <a href="javascript:;"  class="btn upload_file" type="button" >请把要导入的Excel文件拖动到这</a>
                      {{-- <a href="">打开excel预览</a> --}}
                 </div>
            </div>
            <input type="hidden" name="excel_path" value="">

            <button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;display: none;' type='button' class='btn btn-block btn-primary' onclick='startImport()'>开始导入</button>
        </form>

    

    </div>
    </div>
@endsection


@section('scripts')
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
     //导入题目
    $('.import_topic').click(function(){
        layer.open({
            type: 1,
            closeBtn: false,
            shift: 7,
            shadeClose: true,
            title:'请把要导入的Excel文件拖动到这',
            content: $('#import_box').html()
        });
    });

    //开始导入题目
    function startImport(){
          layer.msg('系统正在整理数据...请耐心等待', {
              icon: 16
             ,shade: 0.01
          });
          $.zcjyRequest('/ajax/auto_generate_chartdata',function(res){
                if(res){
                        layer.msg(res, {
                        icon: 1,
                        skin: 'layer-ext-moon' 
                        });
                       //
                       setTimeout(function(){
                        location.reload();
                       },1000);
                    
                }
                else{
                    click_dom.find('a').text('上传失败╳,请重新上传 ');
                }
          },$('#import_form').serialize());
    }

    //图片文件上传
    var myDropzone = $(document.body).dropzone({
        url:'/ajax/uploads',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        addRemoveLinks:false,
        maxFiles:100,
        autoQueue: true, 
        previewsContainer: ".attach", 
        clickable: ".type_files",
        headers: {
         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        addedfile:function(file){
            console.log(file);
        },
        totaluploadprogress:function(progress){
            progress=Math.round(progress);
            click_dom.find('a').text(progress+"%");

        },
        queuecomplete:function(progress){
            console.log(progress);
            click_dom.find('a').text('上传完毕√');
        },
        success:function(file,data){
            if(data.code == 0){
                console.log('上传成功:'+data.message.src);
                if(data.message.type == 'image'){
                    click_dom.find('img').attr('src',data.message.src);
                }
                else if(data.message.type == 'sound'){
                    click_dom.find('audio').show().attr('src',data.message.src);
                }
                else if(data.message.type == 'excel'){
                    console.log($('#import_form').find('input[name=excel_path]'));
                    $('#import_form').find('input[name=excel_path]').val(data.message.current_src);
                    $('.import_class').find('button').show();
                    return;
                }
                if(click_dom.data('type') == 'question'){
                    $('input[name=attach_sound_url]').val(data.message.src);
                }
                else if(click_dom.data('type') == 'selection'){
                    $('input[name=selection_sound_url]').val(data.message.src);
                }
                else{
                    $('input[name=attach_url]').val(data.message.src);
                }
          
            }
            else{
                click_dom.find('a').text('上传失败╳ ');
                alert('文件格式不支持!');
            }
      },
      error:function(){
        console.log('失败');
      }
    });
    var click_dom;
    $(document).on('click','.type_files',function(){
        click_dom = $(this);
        console.log('aa');
        $('input[type=file]').trigger('click');
    });
</script>
@endsection
