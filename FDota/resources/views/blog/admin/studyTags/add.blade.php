@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">添加学习资料标签</div>
            <div class="panel-body">
                <!--- blogAdminStudyTagsCreate Url --->
                <form method="POST" action="{{ route('blogAdminStudyTagsCreate') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                    <!--- tag-name Label - title Field --->
                    <div class="form-group">
                        <label for="title">tag-name:</label>
                        <input class="form-control" name="title" type="text" id="title">
                    </div>
                    <!--- submit ! submit ! --->
                    <div class="form-group">
                        <input class="btn btn-primary form-control" type="submit" value="submit !">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
