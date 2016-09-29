@extends('main')

@section('title', '| Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h2>Categories</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="well">
                {{ Form::open(['route' => 'categories.index']) }}
                <h2>New category</h2>
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name',null, ['class' => 'form-control']) }}

                {{ Form::submit('Create new category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection