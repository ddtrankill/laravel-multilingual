@extends('main')

@section('title', '| Create new post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
    <h1>Create new post</h1>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#eng" aria-controls="eng" role="tab" data-toggle="tab">Eng</a></li>
        <li role="presentation"><a href="#ua" aria-controls="ua" role="tab" data-toggle="tab">Ua</a></li>
    </ul>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 tab-content">
            <div role="tabpanel" class="tab-pane active" id="eng">
                {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
                {!! Form::label('title_en', 'Title: ') !!}
                {!! Form::text('title_en', null ,array('class' => 'form-control input', 'required' => '')) !!}

                {!! Form::label('slug', 'Slug:') !!}
                {!! Form::text('slug', null, ['class' => 'form-control output', 'required' => '']) !!}

                {!! Form::label('category_id', 'Category: ') !!}
                <select name="category_id" id="" class="form-control">
                    @foreach($categories as $category)
                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('featured_image', 'Upload image') }}
                {{ Form::file('featured_image') }}

                {{Form::label('body_en','Post body:')}}
                {!! Form::textarea('body_en', null, ['class' => 'form-control', 'required' => '']) !!}

            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
                {!! Form::label('title_ua', 'Заголовок: ') !!}
                {!! Form::text('title_ua', null ,array('class' => 'form-control', 'required' => '')) !!}

                {!! Form::label('body_ua','Контент:') !!}
                {!! Form::textarea('body_ua', null, array('class' => 'form-control')) !!}

            </div>
            {!! Form::submit('Create post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <script>
        //
        $(document).ready( function() {
            $('.input').stringToSlug({
                getPut: '.output',
                space: '_'
            });
        });
    </script>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/jquery.stringtoslug.min.js') !!}
    {!! Html::script('js/script.js') !!}
@endsection