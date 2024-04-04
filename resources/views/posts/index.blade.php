@extends('layouts.app')
@section('titleName')
    Post - Admin Panel
@endsection
@section('content')
    @if ($users->count() > 0)
        <div class="text-center my-4">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create A Post</a>
        </div>
        @if (session('msg'))
            <div class="alert alert-info">
                {{ session('msg') }}
            </div>
        @endif
        @if ($posts->count() > 0)
            <table class="table text-center table-responsive" id="myTable">
                <thead>
                    <tr>
                        @foreach ($posts->first()->getAttributes() as $key => $value)
                            @if ($key !== 'updated_at')
                                @if ($key === 'user_id')
                                    <th scope="col">{{ str_replace($key, 'user_name', $key) }}</th>
                                @else
                                    <th scope="col">{{ $key }}</th>
                                @endif
                            @endif
                        @endforeach
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            @foreach ($post->getAttributes() as $key => $value)
                                @if (!in_array($key, ['id', 'updated_at']))
                                    <td>
                                        @if ($key === 'description')
                                            {{ str_replace($value, '*******', $value) }}
                                        @elseif($key === 'user_id')
                                            {{ $post->user->name }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            <td class="d-flex justify-content-center align-items-center gap-1">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this Post?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center my-4">
                <form action="{{ route('posts.clear') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete All Posts?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete All Posts</button>
                </form>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                Not Have A Post Create A One
            </div>
        @endif
    @else
        <div class="alert alert-info text-center" role="alert">
            Not Have a User Return Back To Users Page Create A User
        </div>
    @endif
@endsection
