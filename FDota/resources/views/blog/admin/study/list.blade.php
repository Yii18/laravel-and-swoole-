@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <h4>收藏列表</h4><hr>
        <table class="table table-hover table-bordered table-condensed table-striped small">
            <tr class="success">
                <th>标题</th>
                <th>HTTP-URL</th>
                <th>图片链接</th>
                <th>所属标签</th>
                <th>操作</th>
            </tr>
            @foreach($list as $l)
                <tr>
                    <td>{{ $l->title }}</td>
                    <td>{{ $l->url }}</td>
                    <td>{{ $l->img }}</td>
                    <td>{{ $l->tags_title }}</td>
                    <td><a href="{{ route('blogAdminStudyUpdate') }}/{{ $l->id }}" class="btn btn-primary btn-xs">修改</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
