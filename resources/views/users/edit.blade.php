@extends('layouts.app')
@section('titleName')
    Edit User - Admin Panel
@endsection
@section('content')
    <div class="container">
        <h2 class="my-5 text-center text-bold">Edit This User</h2>
        <form class="row g-3" method="post" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('put')
            @foreach ($user->getAttributes() as $key => $value)
                @if (!in_array($key, ['created_at', 'updated_at', 'id']))
                    @if ($key !== 'password')
                        <div class="col-12">
                            <label for="{{ $key }}" class="form-label text-capitalize">{{ $key }}</label>
                            <input type="text" name="{{ $key }}" class="form-control" id="{{ $key }}"
                                value="{{ old($key) ? old($key) : $value }}">
                            @error($key)
                                <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <div class="col-12">
                            <label for="{{ $key }}" class="form-label text-capitalize">{{ $key }}</label>
                            <input type="password" name="{{ $key }}" class="form-control"
                                id="{{ $key }}">
                            @error($key)
                                <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                @endif
            @endforeach
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    @endsection
