@extends('layouts.app')
@section('titleName')
    Create New User - Admin Panel
@endsection
@section('content')
    <div class="container">
        <h2 class="my-5 text-center text-bold">Create a New User</h2>
        <form class="row g-3" method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
                @error('username')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                @error('password')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                @error('phone')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    @endsection
