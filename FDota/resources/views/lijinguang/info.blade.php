<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>长沙市一中李锦广</title>
    <link rel="stylesheet" href="{{ asset('lijinguang/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lijinguang/css/app.css') }}">
</head>
<style>
    html, body {
        padding: 0;
        margin: 0;
        background: #faf7ee;
        color: #34495E;
    }

    .topbg {
        background: url({{ asset('lijinguang/images/top-bg.png') }}) no-repeat center #faf7ee;
        width: 100%;
        height: 90px;
        padding-top: 10px;
        margin-bottom: 20px;
    }

    .desc li {
        float: left;
        list-style: none;
        margin-right: 10px;
        margin-bottom: 20px;
        height: 43px;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .desc li {
            margin-bottom: 0;
        }

        .rank dt{
            margin: 10px 0;
        }

        .rank dd {
            padding: 0;
        }
    }

    .dt {
        line-height: 43px;
        font-size: 16px;
        color: #9b9b9b;
        font-weight: 400;
        font-style: normal;
    }

    .dd {
        line-height: 42px;
        color: #34495E;
        font-weight: 400;
    }

    .rank {
        margin-top: 20px;
    }
    
    .rank dd{
        padding: 10px 0;
        color: red;
    }

    .rank dt{
        margin: 10px 0;
    }
</style>
<body>
    <div class="topbg">
        <div class="col-md-8 col-md-offset-2">
            <img class="img-responsive" src="{{ asset('lijinguang/images/logo.jpg') }}" alt="">
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-6">
            <img class="img-rounded img-responsive" src="{{ asset('lijinguang/images/IMG_0251.JPG') }}" alt="">
        </div>
        <div class="col-md-6">
            <h3 class="username">李锦广 <small>LiJinGuang</small></h3>
            <ul class="desc list-unstyled">
                <li>
                    <span class="dt">身高：</span>
                    <span class="dd">183cm</span>
                </li>
                <li>
                    <span class="dt">体重：</span>
                    <span class="dd">78kg</span>
                </li>
                <li>
                    <span class="dt">年龄：</span>
                    <span class="dd">18周岁</span>
                </li>
                <li>
                    <span class="dt">运动员级别：</span>
                    <span class="dd">国家一级运动员</span>
                </li>
                <li>
                    <span class="dt">民族：</span>
                    <span class="dd">汉族</span>
                </li>
                <li>
                    <span class="dt">司值：</span>
                    <span class="dd">足球门将</span>
                </li>
                <li>
                    <span class="dt">爱好：</span>
                    <span class="dd">踢球、唱歌</span>
                </li>
                <li>
                    <span class="dt">电话：</span>
                    <span class="dd">18674816338</span>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <hr>
        <div class="rank col-md-12">
            <dl class="dl-horizontal">
                <dt>2017年湖南省青少年足球锦标赛</dt>
                <dd>湖南省男子组第一名</dd>

                <dt>2016-2017全国中学生校园足球联赛</dt>
                <dd>西南赛区团体 第二名，个人荣获最佳守门员奖，全国总赛区 第四名</dd>

                <dt>2015-2016全国中学生校园足球联赛</dt>
                <dd>西南赛区 第二名，全国总赛区 第九名</dd>

                <dt>十三届全国中学生运动会高中男子足球预赛2016</dt>
                <dd>代表湖南省参赛</dd>

                <dt>湖南省第一届中学生运动会2015</dt>
                <dd>湖南省男子足球 第一名</dd>

                <dt>湖南省第十二届运动会2014</dt>
                <dd>湖南省男子足球乙组 第二名</dd>
            </dl>
        </div>
        <hr>
        <div class="col-md-12">
            <figure id="showcase">
                <section></section>
                <section></section>
                <section></section>
                <section></section>
            </figure>
        </div>
    </div>
</body>
</html>