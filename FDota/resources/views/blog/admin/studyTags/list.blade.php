@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <h4>收藏标签列表</h4><hr>
        <table class="table table-hover table-bordered table-condensed table-striped small">
            <tr class="success">
                <th>标签名</th>
                <th>操作</th>
            </tr>
            @foreach($list as $l)
                <tr>
                    <td>{{ $l->title }}</td>
                    <td><a href="{{ route('blogAdminStudyTagsUpdate') }}/{{ $l->id }}" class="btn btn-primary btn-xs">修改</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
