@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="admin" class="form-label">Admin</label>
                <select id="admin" name="admin" class="form-select" required>
                    <option value="1" {{ $user->admin ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$user->admin ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
@endif
        </form>
    </div>
@endsection
