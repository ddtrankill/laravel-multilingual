@extends('main')

@section('meta')
    <meta name="description" content="{{$description->title}}" >
@endsection

@section('title', "| $description->title")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img src="{{ asset('images/' . $post->image) }}" height="400" width="800">
                <h1>{{ $description->title }}</h1>
                <p>{!! $description->body !!}</p>
            <hr>
            <p>Posted In: {{ $post->category->name }}</p>
        </div>
    </div>
@endsection