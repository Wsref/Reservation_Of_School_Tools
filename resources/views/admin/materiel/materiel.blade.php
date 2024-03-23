@extends('layouts.master')

@section('title')
    Admin_app_materiel
@endsection

@section('style')
    <style>
        .quan{
            color: rgb(130, 10, 2);
        }
        .rectangular-input {
        border-radius: 0; 
        }
    </style>
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
                            <input type="text" name="nom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                            <label for="">Categorie:</label>
                            <select name="category" class="form-control rectangular-input" required>
                                <option value="" disabled selected>choisir</option>
                                <option value="fétes">fétes</option>
                                <option value="foot_ball">foot_ball</option>
                                <option value="ping_pong">ping_pong</option>
                                <option value="autre">autre</option>
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Quantite:</label>
                                <input type="number" id="numbo1" name="quantite" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Image:</label>
                                <input type="file" name="image" class="form-control rectangular-input" required>
                            </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-sm btn-primary">Ajouter</button>
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
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-sm btn-danger">Oui</button>
          </div>
        </form>
      </div>
    </div>
</div>

{{-- end delet-confirmation-modal --}}

{{-- edit-materiel-modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edite Matériel</h3>
            </div>
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" id="Editnom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                            <label for="">Categorie:</label>
                            <select name="category" id="Editcategory" class="form-control rectangular-input" required>
                                <option value="" disabled selected>choisir</option>
                                <option value="fétes">fétes</option>
                                <option value="foot_ball">foot_ball</option>
                                <option value="ping_pong">ping_pong</option>
                                <option value="autre">autre</option>
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Quantite:</label>
                                <input type="number" name="quantite" id="Editquantite" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                                <img src="" id="Editimage" width="300px" height="100px">      
                            </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
                    </div>
            </form>
        </div>
    </div>
</div>
{{-- end edit-materiel-modal --}}

 <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
            <h6>
                <button type="button" class="btn btn-sm btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#exampleModal" >+</button>
                Matériels</h6>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <input type="text" value=""  placeholder="Matériel..." id="searc">
                </li>
            </ul>
                
            
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <td><strong>Nom</strong></td>
                        <td><strong>Categorie</strong></td>
                        <td><strong>Quantité</strong></td>
                    </thead>
                    <tbody class="main-data">
                        @foreach ($materiels as $materiel)
                            
                        <tr>
                            <td>{{ $materiel->name }}</td>
                            <td>{{ $materiel->category }}</td>
                            <td>{{ $materiel->quantite }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary editbtn" data-bs-toggle="modal" data-bs-target="#editModal" value="{{ $materiel->id }}">Editer</button> 
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#deletModal" value="{{ $materiel->id }}">Supprimer</button>                 
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tbody id="search-content" class="searched-data">

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6>Quantité disponible chaque heure aujourd'hui</h6>
            </div>
            <div class="card-body">
                @if (session('dynQuantVid'))
                    <p>{{ session('dynQuantVid') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <td><strong>Nom</strong></td>
                            <td><strong>Date</strong></td>
                            <td><strong>De</strong></td>
                            <td><strong>A</strong></td>
                            <td><strong>Quantité restante</strong></td>
                        </thead>
                        <tbody class="">
                            @foreach ($dynQuantities as $data)
                                
                            <tr>
                                <td>{{ $data->materiels->name }}</td>
                                <td>{{ $data->date_reserve }}</td>
                                <td>{{ $data->time_reserve }}</td>
                                <td>{{ $data->time_reserve_end }}</td>
                                <td><span class="quan"><strong>{{ $data->quantite }}</strong></span></td>
                            </tr>
    
                            @endforeach
    
                        </tbody>

                    </table>
                    <div class="paginData">
                        {{ $dynQuantities->links() }}
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
            var materielId = $(this).val();
            var url = "{{ url('/delete-materiel/yxkpq=') }}" + materielId;
            $('#delete_modal_form').attr('action', url);
        });

        $('.editbtn').click(function () {
            var materielId = $(this).val();
            var url = "{{ url('/update-materiel/vbgf=') }}" + materielId;
            $.ajax({
                type:'get',
                url:'{{ URL::to('get_materiel_edited_data') }}',
                data:{'materielId':materielId},
                success:function(response){
                    $('#Editnom').val(response.nom);
                    $('#Editcategory').val(response.category);
                    $('#Editquantite').val(response.quantite);
                    var im= response.image;
                    var pathImg = "http://127.0.0.1:8000/myImg/materiels/" + im;
                    console.log('pathImg',pathImg);
                    $('#Editimage').attr('src',pathImg);
                }
            });
            $('#editModalForm').attr('action', url);
        });
    });
</script>

<script>

$('#searc').on('keyup',function()
  {
      
      $value = $(this).val();

      if($value){
          $('.main-data').hide();
          $('.searched-data').show();
          

      }else{
          $('.main-data').show();
          $('.searched-data').hide(); 
          
      }

      $.ajax({
          type:'get',
          url:'{{URL::to('search-materiel')}}',
          data:{'search':$value},
          success:function(response){
              $('#search-content').html(response.data);                
            // begin
                    $('.deletebtn').click(function () {
                    var materielId = $(this).val();
                    var url = "{{ url('/delete-materiel/yxkpq=') }}" + materielId;
                    $('#delete_modal_form').attr('action', url);
                    });

                    $('.editbtn').click(function () {
                        var materielId = $(this).val();
                        var url = "{{ url('/update-materiel/vbgf=') }}" + materielId;
                        $.ajax({
                            type:'get',
                            url:'{{ URL::to('get_materiel_edited_data') }}',
                            data:{'materielId':materielId},
                            success:function(response){
                                $('#Editnom').val(response.nom);
                                $('#Editcategory').val(response.category);
                                $('#Editquantite').val(response.quantite);
                                var im= response.image;
                                var pathImg = "http://127.0.0.1:8000/myImg/materiels/" + im;
                                console.log('pathImg',pathImg);
                                $('#Editimage').attr('src',pathImg);
                            }
                        });
                        $('#editModalForm').attr('action', url);
                    });
            // end
               
          }
      });


  });


</script>

<script>
    document.getElementById('numbo1').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });
</script>

@endsection

