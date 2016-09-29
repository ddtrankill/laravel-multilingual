@extends('main')

@section('title', '| Edit post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#eng" aria-controls="eng" role="tab" data-toggle="tab">Eng</a></li>
        <li role="presentation"><a href="#ua" aria-controls="ua" role="tab" data-toggle="tab">Ua</a></li>
    </ul>
    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH']) !!}
        <div class="col-md-8 tab-content">
            <div role="tabpanel" class="tab-pane active" id="eng">
                {{ Form::label('title_en', 'Title: ') }}
                <input name="title_en" type="text" class="form-control" required value="{{ $description_en->title }}">

                {!! Form::label('slug', 'Slug:',  ['class' => 'form-spacing-top']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'required' => '']) !!}

                {!! Form::label('category_id', 'Category: ',  ['class' => 'form-spacing-top']) !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

                {{ Form::label('body_en', 'Body: ', ['class' => 'form-spacing-top']) }}
                <textarea name="body_en" id="body_en" class="form-control" required>{{ $description_en->body }}</textarea>
            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
                {!! Form::label('title_ua', 'Заголовок: ') !!}
                <input name="title_ua" type="text" class="form-control" value="{{ $description_ua->title }}">

                {!! Form::label('body_ua','Контент:') !!}
                <textarea name="body_ua" class="form-control" required>{{ $description_ua->body }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd>{{ date('M j, Y  H:ia', strtotime($post->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last updated:</dt>
                    <dd>{{ date('M j, Y  H:ia', strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id),array('class' => 'btn btn-danger btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
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
    {!! Html::script('js/jquery.stringtoslug.js') !!}
    {!! Html::script('js/script.js') !!}

@endsection