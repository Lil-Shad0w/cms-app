@extends('layouts.app')
    @section('content')   
<div class="row">
    @auth
    <div class="col-md-4">
        <ul class="list-group">
        @if (auth()->user()->isAdmin())
        <li class="list-group-item"><a href="{{ route('users.index') }}">Users</a></li>
            
        @endif
        <li class="list-group-item"><a href="/posts"> Posts </a></li>
        <li class="list-group-item"><a href="/categories"> Category </a></li>
        <li class="list-group-item"><a href="/tags"> Tags </a></li>

        </ul>

        <ul class="list-group mt-5">
                <li class="list-group-item"><a href="{{ route('trashed-posts.index') }}"> Trashed Post </a></li>    
        </ul>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">My profile</div>
            <div class="card-body">
            <form action="{{ route('users.update-profile') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
                <div class="form-group">
                    <label for="about">About me</label>
                <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>

                </div>
                <button class="btn btn-success">Update profile</button>
                
            </form>
            </div>
        </div>
    </div>

    
    @endauth 
    
</div>
    @endsection
