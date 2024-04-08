@extends('layouts.admin')
@section('title', 'Admin Home Page')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="welcome-message">
            <img src="{{ asset('images/admin/Instagram.png') }}" alt="Welcome Image" class="img-fluid" style="max-width: 200px;">
            <h2>Welcome Instagram Admin!</h2>
            <p>We are glad to have you here. Please explore the admin panel to manage your Instagram account.</p>
        </div>
    </div>
</div>
@endsection
