<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '文章标题:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@if(count($cats))
    <div class="form-group col-sm-12">
         {!! Form::label('cat', '分类:') !!}

         <select name="cat_slug" class="form-control">
             @foreach($cats as $cat)
                <option value="{!! $cat->slug !!}" @if(isset($post) && $post->cat_slug == $cat->slug) selected="selected" @endif>{!! $cat->name !!}</option>
             @endforeach
         </select>

    </div>
@endif

<!-- Des Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('des', '描述:') !!}
    {!! Form::textarea('des', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', '图片:') !!}

    <div class="form-group">
        <div class="input-append">
            {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
            <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image')">选择图片</a>
            <img src="@if(isset($post)) {{$post->image}} @endif" style="max-width: 100%; max-height: 150px; display: block;">
        </div>
    </div>

</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', '详情:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control intro']) !!}
</div>

<!-- Video Url Field -->
<div class="form-group col-sm-12">
    {!! Form::label('video_url', '视频链接地址:') !!}
 
    {!! Form::text('video_url', null, ['class' => 'form-control']) !!}
   <div class="input-append attach type_files" style="display:  block;" data-type="question">
            <a href="javascript:;"  class="btn upload_file" type="button" >点击选择视频文件或拖拽到这里</a>
       
            <audio src="@if(isset($post)) {!! $post->video_url !!} @endif" controls="controls" style="@if(isset($post) && !empty($post->video_url)) display：block; @else display:none; @endif"> </audio>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('posts.index') !!}" class="btn btn-default">返回</a>
</div>
