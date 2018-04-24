@extends('auth.layout')
@section('styles')
    <style>
        #login {
            margin-top: 10%;
        }

        .panel {
            background-color: rgba(50,50,50,0.6);
            border-color: transparent;
            padding: 20px 40px 60px 40px;
            color: #ccc;
        }

        .form-control {
            border: 0;
        }

        .control-label {
            padding-left: 5px;
            font-size: 13px;
            font-weight: 500;
        }

        .form-horizontal .form-group {
            margin-left: 0;
            margin-right: 0;
        }

        .panel-body {
            padding: 0;
        }

        .title {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 20px;
            color:#ccc;
            font-size: 14px;
            font-weight: 600;
        }

        .back {
            position: absolute;
            right:60px;
            bottom: 40px;
            color: rgb(152, 152, 152);
        }
    </style>
@endsection
@section('content')
    <div id="login" class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="title">人生苦短 ~  ~ </div>
                <form class="form-horizontal" role="form" method="POST" action="">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email" class="control-label">邮箱:</label>
                        <input v-model="email" id="email" type="email" class="form-control" name="email" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">密码:</label>
                        <input v-model="password" id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> 两周内免登录
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">登录</button>
                        <br>
                        <a href="/register" class="btn btn-primary btn-block">我用 Python</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="back">
            <a href="javascript:history.go(-1)">返回</a>
        </div>
    </div>
@endsection
