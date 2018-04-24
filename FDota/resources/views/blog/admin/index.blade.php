<!DOCTYPE html>
<html class="theme-next muse use-motion" lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#222">
    <meta name="renderer" content="webkit">
    <title>FDota</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('ico/weng.jpeg')}}">
    <link rel="stylesheet" href="{{asset('blog/admin/app.css')}}">
    <script src="{{asset('blog/admin/app.js')}}"></script>
</head>
<body>
<div class="overlay expanded">

    <form class="overlay-sidebar">
        <div class="container-fluid">
            <div>@{{ title }}</div>
            <h4 style="text-align: center">Mr.Robotw</h4>
            <!--- 标题 Field --->
            <div class="form-group">
                {!! Form::label('title', '标题:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <!--- 副标题 Field --->
            <div class="form-group">
                {!! Form::label('small_title', '副标题:') !!}
                {!! Form::text('small_title', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div id="customize-footer-actions" class="wp-full-overlay-footer">
            <div class="devices">
                <button type="button" class="preview-desktop active" data-device="desktop">
                    <span class="screen-reader-text">进入桌面预览模式</span>
                </button>
                <button type="button" class="preview-tablet" data-device="tablet">
                    <span class="screen-reader-text">进入平板预览模式</span>
                </button>
                <button type="button" class="preview-mobile" data-device="mobile">
                    <span class="screen-reader-text">进入移动预览模式</span>
                </button>
            </div>
            <button type="button" class="collapse-sidebar button-secondary">
                <span class="collapse-sidebar-arrow"></span>
                <span class="collapse-sidebar-label">收起</span>
            </button>
        </div>
    </form>
    <div class="overlay-main">
        <iframe src="{{url('/')}}" title="站点预览"></iframe>
    </div>
</div>
</body>

<script>
    $(function () {
        new Vue({
            el: 'body',
            data: {
                title: ''
            },
            methods: {
            }
        });
    });
</script>
<script>
    $('.devices button').on('click', function () {
        $('.devices button').each(function () {
            $(this).removeClass('active');
        });

        var className = 'overlay preview-' + $(this).attr('data-device');

        if ( $('.overlay').hasClass('expanded') ) {
            className += ' expanded';
            $('.overlay').attr('class', className);
        } else {
            className += ' collapsed';
            $('.overlay').attr('class', className);
        }

        $(this).addClass('active');
    });
    $('.collapse-sidebar.button-secondary').on('click', function () {
        var self = $('.overlay');
        if (self.hasClass('expanded')) {
            self.removeClass('expanded');
            self.addClass('collapsed');
            $('.devices').css('display', 'none');
            $('.collapse-sidebar-label').css('display', 'none');
            $('.wp-full-overlay-footer').css('border', 0);
        } else {
            self.removeClass('collapsed');
            self.addClass('expanded');
            $('.devices').css('display', '');
            $('.collapse-sidebar-label').css('display', '');
            $('.wp-full-overlay-footer').css('border', '');
        }
    });
</script>
</html>