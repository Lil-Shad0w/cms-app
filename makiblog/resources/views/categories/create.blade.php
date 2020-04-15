@extends('layouts.app')
@section('content')
    <div class="card card-default border-primary">
        <div class="card-header text-primary">
            {{ isset($category) ? 'Uredi kategoriju' : 'Kreiraj kategoriju' }}
        </div>
        <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')  }}" method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Naziv</label>
            <input type="text" id="name" name="name" class="form-control"  value="{{ isset($category) ? $category->name : ''}}">
            </div>
                <div class="form-group">
                    <div class="text-center">
                    <button class="btn btn-primary" type="submit">{{ isset($category) ? 'Uredi' : 'Kreiraj'}}</button>
                    </div>
                </div>
        </form>
        </div>
    </div>
@endsection