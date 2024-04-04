@extends('layouts.app')
@section('titleName')
    Users - Admin Panel
@endsection
@section('content')
    <div class="text-center my-4">
        <a href="{{ route('users.create') }}" class="btn btn-success">Create A User</a>
    </div>
    @if (session('msg'))
        <div class="alert alert-info">
            {{ session('msg') }}
        </div>
    @endif
    @if ($users)
        <table class="table text-center table-responsive" id="myTable">
            <thead>
                <tr>
                    @foreach (array_keys($users[0]) as $key)
                        @if ($key !== 'updated_at')
                            <th scope="col">{{ $key }}</th>
                        @endif
                    @endforeach
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @foreach ($user as $key => $value)
                            @if ($key !== 'id' && $key !== 'updated_at')
                                <td>
                                    @if ($key === 'password')
                                        {{ str_replace($value, '*******', $value) }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            @endif
                        @endforeach
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('users.show', $user['id']) }}" class="btn btn-info">View</a>
                            <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $user['id']) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
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
            <form action="{{ route('users.clear') }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete All Users?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete All Users</button>
            </form>
        </div>
    @else
        <div class="alert alert-info text-center" role="alert">
            Not Have a User Create A One
        </div>
    @endif
@endsection
