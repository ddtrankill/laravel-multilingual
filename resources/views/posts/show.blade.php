@extends('main')

@section('title','| View post')

@section('content')

<div class="row">
    <div class="col-md-8">
        <img src="{{ asset('images/' . $post->image) }}" height="350" width="700">
        @foreach($descriptions as $description)
            <h1>{{ $description->title }}</h1>
            <p class="lead">{!! $description->body !!}</p>
            <hr>
        @endforeach
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <label>Url:</label>
                <p><a href="{{ url('blog/' . $post->slug) }}">{{ url('blog/' . $post->slug) }}</a></p>
            </dl>
            <dl class="dl-horizontal">
                <label>Category:</label>
                <p>{{ $post->category->name }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Created at:</label>
                <p>{{ date('m/j/Y  H:i', strtotime($post->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last updated:</label>
                <p>{{ date('m/j/Y  H:i', strtotime($post->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.edit', 'Edit', array($post->id),array('class' => 'btn btn-primary btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

                    {!! Form::close() !!}
                </div>
                <div class="col-sm-12">
                    {!! Html::linkRoute('posts.index', '<< All posts', null,['class' => 'btn btn-default btn-block btn-h1-spacing']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection