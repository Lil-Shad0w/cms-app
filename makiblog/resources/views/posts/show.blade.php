@extends('layouts.app')

@section('content')
    <a class="btn btn-info" href="/posts">Vrati se nazad</a>
    <h1 class="text-center">{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->featured}}" alt="image">
    <div>{!!html_entity_decode($post->content)!!}</div>
    
@endsection