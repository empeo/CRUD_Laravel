@extends('layouts.app')
@section('titleName')
    Edit Post - Admin Panel
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-info">
            {{ session('msg') }}
        </div>
    @endif
    <div class="container">
        <h2 class="my-5 text-center text-bold">Edit This Post</h2>
        <form class="row g-3" method="post" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('put')
            @foreach ($post->getAttributes() as $key => $values)
                @if (!in_array($key, ['created_at', 'updated_at', 'id', 'user_id']))
                    <div class="col-12">
                        <label for="{{ $key }}" class="form-label text-capitalize">{{ $key }}</label>
                        <input type="text" name="{{ $key }}" class="form-control" id="{{ $key }}"
                            value= "{{ old($key) ? old($key) : $values }}">
                        @error($key)
                            <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            @endforeach
            <div class="col-12">
                <label for="user_share text-capitalize">What is the user's share</label>
                <select id="user_share" class="form-select" aria-label="Default select example" name="user_id">
                    @foreach ($users as $user)
                        <option @selected($post->user_id === $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary text-capitalize">Create</button>
            </div>
        </form>
    @endsection
