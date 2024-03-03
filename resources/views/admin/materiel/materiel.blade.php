@extends('layouts.master')

@section('title')
    Admin_app_materiel
@endsection

@section('content')

{{-- add-materiel-modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Nouveau Matériel</h3>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form action="{{ url('/save-materiel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="">Categorie:</label>
                            <select name="category" class="form-control">
                                <option value="foot_ball">foot_ball</option>
                                <option value="basket_ball">basket_ball</option>
                                <option value="volley_ball">volley_ball</option>
                                <option value="ping_pong">ping_pong</option>
                                <option value="matériel_fetes">matériel_fetes</option>
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Quantite:</label>
                                <input type="number" name="quantite" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Image:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-sm btn-primary">Ajouter Matériel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
{{-- end add-materiel-modal --}}

{{-- delet-confirmation-modal --}}
<div class="modal fade" id="deletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <form id="delete_modal_form" method="POST">
          @csrf
          @method('DELETE')
         
          <div class="modal-body">
              <h6>Est ce que vous etes sure de supprimmer ce materiel?</h6>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-sm btn-primary">Confrmer</button>
          </div>
        </form>
      </div>
    </div>
</div>

{{-- end delet-confirmation-modal --}}

 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h5>Matériels
                <button type="button" class="btn btn-sm btn-secondary float-end"  data-toggle="modal" data-target="#exampleModal" >Ajouter</button>
            </h5>
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                <button type="button" class="btn-close float-right" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="text-primary">
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Quantité</th>
                        <th>Mise a jour a</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody class="main-data">
                        @foreach ($materiels as $materiel)
                            
                        <tr>
                            <td>{{ $materiel->name }}</td>
                            <td>{{ $materiel->category }}</td>
                            <td>{{ $materiel->quantite }}</td>
                            <td></td>
                            <td>
                                <a href="{{ url('/edit-materiel/yxwiu=' . $materiel->id ) }}" class="btn btn-sm btn-secondary">Editer</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary deletebtn" data-toggle="modal" data-target="#deletModal" data-materiel-id="{{ $materiel->id }}">Supprimer</button>                 
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tbody id="search-content" class="searched-data">

                    </tbody>
                </table>
                <div class="paginData">
                    {{ $materiels->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</div> 
@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        $('.deletebtn').click(function () {
            var materielId = $(this).data('materiel-id');
            var url = "{{ url('/delete-materiel/yxkpq=') }}" + materielId;
            $('#delete_modal_form').attr('action', url);
        });
    });
</script>

<script>

    $('#search').on('keyup',function()
    {
        
        $value = $(this).val();

        if($value){
            $('.main-data').hide();
            $('.searched-data').show();
            $('.paginData').hide();

        }else{
            $('.main-data').show();
            $('.searched-data').hide(); 
            $('.paginData').show();  
        }

        $.ajax({
            type:'get',
            url:'{{URL::to('search-materiel')}}',
            data:{'search':$value},
            success:function(response){
                $('#search-content').html(response.data);
                $('#pagin').html(response.pagination);
                var materielIds = response.materilIds;
                 console.log('materielIds search',materielIds);
                materielIds.forEach(urlid => {
                    $('.deletebtn').click(function () {
                    var url = "{{ url('/delete-materiel/yxkpq=') }}" + urlid;
                    $('#delete_modal_form').attr('action', url);
                     });
                });
            }
        });


    });


</script>

@endsection