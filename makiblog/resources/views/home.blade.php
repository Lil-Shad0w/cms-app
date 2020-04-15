@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-defoult border-primary">
                <div class="card-header text-primary">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Dobrodošli
                </div>
            </div>
            <br>
            <h4 class="text-center">Vasi postovi</h4>
            <hr>
            @if (count($posts) > 0)
        <table class="table table-bordered table-dark">
            <thead>
                <th>Naslov</th>
                <th></th>
            </thead>
            <tbody>
              
                @foreach ($posts as $post)
                    <tr>
                    <td>{{ $post->title }}</td>
                
                    <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Uredi</a>
                    
                    </td>
                    <td>
                        <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">{{ $post->trashed() ? 'Obrisi' : 'Smece' }}</button>
                           </form>
                    </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>
        @else 
        <h3 class="text-center">Nemate ni jedan post</h3>
    @endif

            
        </div>
    </div>
</div>
@endsection
