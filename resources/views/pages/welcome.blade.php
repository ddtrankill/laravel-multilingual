@extends('main')

@section('title','| Homepage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome</h1>
                <p class="lead">Thank you for visiting!</p>
                <p><a class="btn btn-primary btn-lg" href="/posts" role="button">Latest posts</a></p>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @foreach($posts as $post)
                        @foreach($post->description as $description)
                            <div class="post">
                                <h3>{{ $description->title }}</h3>
                                <p>{{  substr($post->body, 0,250) }}{{ strlen($description->body) > 250 ? '...' : '' }}</p>
                                <a href="{{ url('blog/' . $post->slug) }}" class="btn btn-primary">Read more</a>
                            </div>
                        @endforeach
                    @endforeach
                    <hr>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <h2>Sidebar</h2>
                </div>
            </div>
        </div>
    </div>
@endsection