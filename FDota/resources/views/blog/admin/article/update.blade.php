@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <main class="main" id="update">
            <div class="main-inner">
            {{ Form::open(array('url' => route('blogAdminArticleUpdate') . '/' . $art->id)) }}
                <input type="hidden" name="username" value="{{ Auth::User()->name }}">
                <!--- 标题 Field --->
                <div class="form-group">
                    {!! Form::label('title', '标题:') !!}
                    {!! Form::text('title', null, ['v-model' => 'title', 'class' => 'form-control']) !!}
                </div>
                <!--- 标签 Field --->
                <div class="form-group">
                    {!! Form::label('tag', '标签:') !!}
                    {!! Form::text('tag', null, ['v-model' => 'tags', 'id' => 'tags-input', 'class' => 'form-control', 'placeholder' => '多个标签请用英文逗号（,）分开']) !!}
                </div>

                <div class="form-group">
                    <span class="tag" v-for="tag in tags.split(',')">
                        <a href="javascript:;" class="glyphicon glyphicon-remove-sign" v-text="tag"></a>
                        <input type="hidden" name="tag[]" :value="tag">
                    </span>
                </div>
                <div style="margin-bottom: 50px">
                    <textarea class="form-control" name="content" cols="30" rows="20">{!! $art->content !!}</textarea>
                </div>
                <!--- Submit submit ! --->
                <div class="form-group">
                    <input class="btn btn-primary form-control" type="submit" value="Submit">
                </div>
                {{ Form::close() }}
            </div>
        </main>
    </div>
    <script>
        new Vue({
            el: '#update',
            data: {
                title: '{{ $art->title }}',
                tags: '{{ $art->tagStr }}'
            }
        });
    </script>
@endsection

