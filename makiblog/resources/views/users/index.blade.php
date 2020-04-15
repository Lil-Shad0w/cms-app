@extends('layouts.app')

@section('content')
    <h3 class="text-center">Korisnici</h3>
    <hr>
    <table class="table table-bordered table-dark">
            <thead>
                
                    <tr>
                        <th>Image</th>
                        <th>Ime</th>
                        <th>Email</th>
                    
                    </tr>
                </thead>
    @if (count($users) > 0)
        @foreach ($users as $user)
        
            
        <tbody>
            <tr>
                <td>
                   <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($user->email) }}" alt="">
                </td>
            <td>
                {{ $user->name }}
            </td>

            <td>
                {{ $user->email }}
            </td>
            <td>
                @if (!$user->isAdmin())
            <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Postavi za admina</button>
            </form>
                @endif
            </td>

            </tr>
        </tbody>
        
        
   
        @endforeach
    </table>
        
    @else
    <p>No users jet</p>

    @endif

        
    
    
@endsection