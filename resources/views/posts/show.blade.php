@extends('layouts.app')
@section('titleName')
    Show Post Information
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-info my-3 fs-3">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
        <div class="card-header bg-primary text-white fs-2 font-weight-bold">Title: {{ $post->title }}</div>
        <div class="card-body">
            @foreach ($post->getAttributes() as $key => $values)
                @if ($key !== 'title' && $key !== 'updated_at' && $key !== 'user_id')
                    <p class="card-text fs-2 text-capitalize"><span
                            class="text-capitalize text-danger font-weight-bolder">{{ $key }}: </span>
                        {{ $values }}</p>
                @elseif($key === 'user_id')
                    <p class="card-text fs-2 text-capitalize"><span
                            class="text-capitalize text-danger font-weight-bolder">{{ str_replace($key, 'user_name', $key) }}:
                        </span> {{ $post->user->name }}
                    </p>
                @endif
            @endforeach
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back To Home</a>
        </div>
    </div>
@endsection
