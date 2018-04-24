@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <h4>文章列表</h4><hr>
        <table class="table table-hover table-bordered table-condensed table-striped small">
            <tr class="success">
                <th>作者</th>
                <th>标题</th>
                <th>标签</th>
                <th>发表时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            @foreach($list as $l)
                <tr>
                    <td>{{ $l->username }}</td>
                    <td>{{ $l->title }}</td>
                    <td>{{ $l->tags }}</td>
                    <td>{{ $l->created_at }}</td>
                    <td>{{ $l->updated_at }}</td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <a href="{{ route('blogAdminArticleDelete') }}/{{ $l->id }}" class="btn btn-danger btn-xs" onclick="if(!confirm('确定 ?')){return false;}">删除</a>
                            <a href="{{ route('blogAdminArticleUpdate') }}/{{ $l->id }}" class="btn btn-primary btn-xs">修改</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
