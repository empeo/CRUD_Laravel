@extends('layouts.app')
@section('titleName')
    Show User Information
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-info my-3">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
        <div class="card-header bg-primary text-white fs-2 font-weight-bold">Name: {{ $user->name }}</div>
        <div class="card-body">
            @foreach ($user->getAttributes() as $key => $value)
                @if (!in_array($key, ['id', 'updated_at', 'name']))
                    <p class="card-text fs-2"><span
                            class="font-weight-bolder text-capitalize text-danger">{{ $key }}: </span>
                        {{ $value }}</p>
                @endif
            @endforeach
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back To Home</a>
        </div>
    </div>
@endsection
