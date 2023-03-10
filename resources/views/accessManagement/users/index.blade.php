@extends('layouts.app')

@section('content')
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
<h4>Users</h4>
@if (auth()->user()->hasRole('administrator'))
<a class="btn btn-primary btn-sm" href="{{ route('access-management.users.create') }}">Create User</a>
@endif
</div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <ul>
                                @foreach ($user->roles as $role)
                                <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if (auth()->user()->hasRole('administrator'))
                                <div class="col-6 pr-1">
                                    <a class="btn btn-sm btn-primary btn-block" href="{{ route('access-management.users.edit', $user) }}">Edit</a>
                                </div>
                                @endif
                                @if (auth()->user()->hasRole('administrator'))
                                <div class="col-6 pl-1">
                                    <form action="{{ route('access-management.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection