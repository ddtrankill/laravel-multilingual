@extends('main')

@section('title','| All posts')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>@lang('translation.all_posts')</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">@lang('translation.new_post')</a>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>Title</th>
                <th>Body</th>
                <th>@lang('translation.created_at')</th>
                </thead>
                <tbody>
                    @foreach($descriptions as $description)
                            <tr>
                                <th>{{ $description->title }}</th>
                                <th>{!! substr($description->body, 0, 50) !!}{!! strlen($description->body) > 50 ? '...' : '' !!}</th>
                                <th>{{ date('m/j/Y  H:i', strtotime($description->updated_at)) }}</th>
                                <th>
                                    <a href="{{ route('posts.show', $description->post_id) }}" class="btn btn-default btn-sm">View</a>
                                    <a href="{{ route('posts.edit', $description->post_id) }}" class="btn btn-default btn-sm">Edit</a>
                                </th>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection