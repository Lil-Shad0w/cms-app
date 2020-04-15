@extends('layouts.app')

@section('content')
<h3 class="text-center">Postovi</h3>
<hr>
@if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="jumbotron">
                <div class="row">
                        
                    <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="/storage/cover_images/{{$post->featured}}" alt="image">
                    </div>
                    <div class="col-md-8 col-sm-8">

                            
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <table class="table">
                                    <tbody>
                                            <tr>
                                                        <td>
                                                        <b>Kategorija:</b> <a href="{{ route('categories.edit', $post->category->id)}}">{{ $post->category->name }}</a>
                                                                </td>
                                                    @if ($post->trashed() && Auth::user()->id == $post->user_id)
                                                    <td>
                                                    <form action="{{ route('restore-posts', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-info btn-sm">Vrati post</button>
                                                </form>
                                                            
                                                            </td>
                                                    @else
                                                    <td>
                                                        @if (Auth::user()->id == $post->user_id)
                                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Uredi</a>
                                                        @endif      
                                                </td> 
                                                    @endif
                                                    @if (Auth::user()->id == $post->user_id)
                                                        
                                                    
                                                    <td>
                                                                <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">{{ $post->trashed() ? 'Obrisi' : 'Smece' }}</button>
                                                                               </form>
                                                    </td>
                                                    @endif
                                                    
                                            </tr>
                                            <tr>
                                            <td><small><b> Objavljeno:</b> {{$post->created_at}}</small></td>
                                                <td><small><b>Autor:</b> {{$post->user->name}}</small></td>
                                            </tr>
                                    </tbody>

                            </table>
                                
                    </div>
            </div>
        </div>
            
        @endforeach
        

        @else
                                <h3 class="text-center">Jos uvek nema posta</h3>
                            @endif
@endsection