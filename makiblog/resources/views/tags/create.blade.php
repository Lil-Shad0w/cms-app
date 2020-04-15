@extends('layouts.app')
@section('content')
    <div class="card card-default border-primary">
        <div class="card-header text-primary">
            {{ isset($tag) ? 'Uredi tag' : 'Kreiraj tag' }}
        </div>
        <div class="card-body">
        <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store')  }}" method="POST">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Naziv</label>
            <input type="text" id="name" name="name" class="form-control"  value="{{ isset($tag) ? $tag->name : ''}}">
            </div>
                <div class="form-group">
                    <div class="text-center">
                    <button class="btn btn-primary" type="submit">{{ isset($tag) ? 'Uredi' : 'Kreiraj'}}</button>
                    </div>
                </div>
        </form>
        </div>
    </div>
@endsection