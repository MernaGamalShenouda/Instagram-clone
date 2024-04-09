@extends('layouts.admin')
@section('title', 'Index Page')

@section('content')
<div class="container mt-5">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Content</th>
                <th>User ID</th>
                <th>Created At</th>
                <th>Published At</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}} <a href="{{ route('posts.show', $post->id) }}">VIEW</a></td>
                <td>{{$post->user->username}}</td>
                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">{{$post->content}}</td>
                <td>{{$post->user->id}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->published_at}}</td>
                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">{{$post->images}}</td>
                <td>
                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container mt-3">
    <div class="row justify-content-end">
        <div class="col-auto">
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

@endsection