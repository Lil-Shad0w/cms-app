@extends('layouts.app')

@section('content')

    <h3 class="text-center">Kategorije</h3>
    <hr>
        @if (count($categories) > 0)
        <table class="table table-bordered table-dark">
            <thead>
                <th>Ime</th>
                <th>Broj postova</th>
                <th></th>
            </thead>
            <tbody>
              
                @foreach ($categories as $category)
                    <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                      {{ $category->posts->count() }}
                    </td>
                    <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Uredi</a>
                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Obriši</button>
                    </td>
                    </tr>
                @endforeach
               
            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form action="" method="POST" id="deleteCategoryForm">
                  @method('DELETE')
                  @csrf
                    <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel">Obrisi kategoriju</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p class="text-center">Da li ste sigurni da zelite da obrisete kategoriju?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne, vrati se</button>
                              <button type="submit" class="btn btn-danger">Da, obrisi</button>
                            </div>
                          </div>

              </form>
            </div>
          </div>
        @else 
        <h3 class="text-center">Nema kategorija jos uvek</h3>
    @endif

    
@endsection

@section('scripts')
    <script>
        function handleDelete(id){    
            var form = document.getElementById('deleteCategoryForm')
            form.action='/categories/'+ id
            $('#deleteModal').modal('show')
        }
    </script>
    
@endsection