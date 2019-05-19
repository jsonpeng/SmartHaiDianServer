<table class="table table-responsive" id="posts-table">
    <thead>
        <tr>
        <th>新闻标题</th>
        <!-- <th>描述</th> -->
        <th>图片</th>
        <!-- <th>Content</th> -->
        <!-- <th>Video Url</th> -->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>{!! $post->name !!}</td>
            <!-- <td>{!! $post->des !!}</td> -->
            <td>{!! $post->image !!}</td>
            <!-- <td>{!! $post->content !!}</td> -->
            <!-- <td>{!! $post->video_url !!}</td> -->
            <td>
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                 <!--    <a href="{!! route('posts.show', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('posts.edit', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>