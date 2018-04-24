@extends('auth.layout')
@section('styles')
    <style>
        #register {
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
    <div id="register" class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="title">
                体は剣で出来ている<br>血潮は鉄で　心は硝子
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label">用户名: </label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="用户名唯一英文或数字组合" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">邮箱:</label>
                        <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">密码: </label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="密码至少6位" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">确认密码: </label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">封印解除</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="back"><a href="javascript:history.go(-1)">返回</a></div>
    </div>
@endsection
