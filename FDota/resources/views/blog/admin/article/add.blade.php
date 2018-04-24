@extends('blog.admin.lside')

@section('rside')
    <div class="col-md-10">
        <main class="main" id="add">
            <div class="main-inner">
                {{ Form::open(array('url' => route('blogAdminArticleCreate'))) }}
                    <!--- 标题 Field --->
                    <div class="form-group">
                        {!! Form::label('title', '标题:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
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
                        {!! Form::textarea('content', '', ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Click Me!',['class'=>'btn btn-primary form-control']) !!}
                {{ Form::close() }}
            </div>
        </main>
    </div>
    <script>
        new Vue({
            el: '#add',
            data: {
                tags: ''
            }
        });
    </script>
@endsection

