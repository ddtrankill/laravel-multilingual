@extends('main')

@section('title', '| ' . trans('translation.latest_posts'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>@lang('translation.greetings')</h1>
                <p><a class="btn btn-primary btn-lg" href="/posts" role="button">@lang('translation.latest_posts')</a></p>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @foreach($posts as $post)
                        @foreach($post->description as $description)
                            @if($description->lang_id == Session::get('language'))
                                <div class="post">
                                    <h3>{{ $description->title }}</h3>
                                    <p>{{  substr(strip_tags($description->body), 0,50) }}{{ strlen(strip_tags($description->body)) > 50 ? '...' : '' }}</p>
                                    <a href="{{ url('blog/' . $post->slug) }}" class="btn btn-primary">@lang('translation.read_more')</a>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <hr>
                </div>
                <div class="col-md-3 col-md-offset-1">
                </div>
            </div>
        </div>
    </div>
@endsection