@extends('layouts.admin')
@section('title', 'Index Page')

@section('content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Number of Posts</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{ route('users.show', $user->id) }}">{{$user->username}}</a></td>
                <td>{{$user->posts_count}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->gender}}</td>
                <td>
                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $users ->links() !!}
@endsection

