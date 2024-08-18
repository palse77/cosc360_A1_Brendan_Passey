{{-- @extends('layouts.app') --}}
@extends('layouts.admin_layout')

@section('content')
    <h1>Edit Blog Post</h1>
    <a href="{{url()->previous()}}">Back</a> 
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
