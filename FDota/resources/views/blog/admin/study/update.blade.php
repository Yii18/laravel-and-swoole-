@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">添加学习资料</div>
            <div class="panel-body">
                <!--- blogAdminStudyCreate Url --->
                <form method="POST" action="{{ route('blogAdminStudyUpdate') }}/{{ $row->id }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <!--- title Label - title Field --->
                    <div class="form-group">
                        <label for="title">title:</label>
                        <input class="form-control" name="title" type="text" id="title" value="{{ $row->title }}">
                    </div>
                    <!--- http-url Label - url Field --->
                    <div class="form-group">
                        <label for="url">http-url:</label>
                        <input class="form-control" name="url" type="text" id="url" value="{{ $row->url }}">
                    </div>
                    <!--- images-url Label - img Field --->
                    <div class="form-group">
                        <label for="img">images-url:</label>
                        <input class="form-control" name="img" type="text" id="img" value="{{ $row->img }}">
                    </div>
                    <!--- tag-name Label - study_tags_id Field --->
                    <div class="form-group">
                        <label for="study_tags_id">tag-name:</label>
                        <select multiple class="form-control" name="study_tags_id">
                            @foreach($tags as $tag)
                                @if($tag->title == $row->tags_title)
                                    <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                @else
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endif
                            @endforeach
                        </select>
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
