@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <h4>用户列表</h4><hr>
        <table class="table table-hover table-bordered table-condensed table-striped small">
            <tr class="success">
                <th>用户名称</th>
                <th>头像</th>
                <th>邮箱</th>
                <th>STEAM昵称</th>
                <th>STEAMID</th>
                <th>授权QQID</th>
                <th>注册时间</th>
            </tr>
            @foreach($list as $l)
                <tr>
                    <td>{{ $l->name }}</td>
                    <td><img src="{{ $l->avatar }}" width="20" class="img-rounded"></td>
                    <td>{{ $l->email }}</td>
                    <td>{{ $l->username }}</td>
                    <td>{{ $l->steamid }}</td>
                    <td>{{ $l->qq_id }}</td>
                    <td>{{ $l->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
