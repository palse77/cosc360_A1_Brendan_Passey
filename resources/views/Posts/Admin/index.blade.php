@extends('layouts.admin_layout')
{{-- @extends('layouts.app') --}}

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Blog Posts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{route('admin.posts.create')}}" class="btn btn-sm btn-outline-secondary">Create Post</a>       
            </div>
        </div>
    </div>

    <div>
        <ul> 
            @foreach ($posts as $author => $authorPosts)  
            <h2>{{ $author }}</h2>
            
            <ul>
                @foreach ($authorPosts as $post)  
                    <li>
                        <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>  
                    </li>
                @endforeach
            </ul>
        @endforeach
        </ul>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif 

    
@endsection