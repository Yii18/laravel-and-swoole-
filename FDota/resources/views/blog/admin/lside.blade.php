@extends('blog.main')
@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">用户</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{route('blogAdminUserList')}}"><span class="glyphicon glyphicon-th-list"></span> 用户管理</a>
                    </li>
                </ul>
                <div class="panel-heading">文章</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a style="display: block;" href="{{route('blogAdminArticleList')}}"><span class="glyphicon glyphicon-th-list"></span> 文章管理</a>
                    </li>
                    <li class="list-group-item">
                        <a style="display: block;" href="{{route('blogAdminArticleCreate')}}"><span class="glyphicon glyphicon-plus"></span> 添加文章</a>
                    </li>
                </ul>
                <div class="panel-heading">收藏</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{route('blogAdminStudyList')}}"><span class="glyphicon glyphicon-th-list"></span> 收藏管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('blogAdminStudyCreate')}}"><span class="glyphicon glyphicon-plus"></span> 添加收藏</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('blogAdminStudyTagsList')}}"><span class="glyphicon glyphicon-th-list"></span> 标签管理</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{route('blogAdminStudyTagsCreate')}}"><span class="glyphicon glyphicon-plus"></span> 添加标签</a>
                    </li>
                </ul>
                <div class="panel-heading">验证信息</div>
                <div class="panel-body">
                    @if(Auth::user()->username && Auth::user()->steamid)
                        <p>已绑定Steam</p>
                        <p>昵称 : {{Auth::user()->username}}</p>
                        <p>数字ID : {{Auth::user()->account_id}}</p>
                        <a href="{{route('dota2Index')}}">Dota2查询</a>
                    @else
                        <p>未绑定steam</p>
                        <a href="{{url('dota2/Oauth2')}}">Steam绑定</a>
                        <p>提供Dota2查询</p>
                    @endif
                </div>
            </div>

        </div>
            @yield('rside')
    </div>
@endsection
