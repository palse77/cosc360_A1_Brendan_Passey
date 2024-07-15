@extends('layouts.app')

@section('content')
    <h1>Blog Post Details</h1>
    <a href="{{url()->previous()}}">Back</a> 
    <ul> 
        <li>ID: {{$post->id }}</li>
        <li>Title: {{$post->title}}</li>
        <li>Content: {{$post->content}}</li>
    </ul>
    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Edit Post</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
    </form>
@endsection