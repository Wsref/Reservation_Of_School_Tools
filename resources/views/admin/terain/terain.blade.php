@extends('layouts.master')

@section('title')
    Admin_app_terains
@endsection

@section('style')
    <style>
        .rectangular-input{
            border-radius: 0px;
        }
        #textarea {
            width: 100%;
            height: 100%;
            padding: 0.5em; 
            box-sizing: border-box; 
        }
    </style>
@endsection


@section('content')


{{-- add-materiel-modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Nouveau Terain</h3>
            </div>
            <form action="{{ url('/save-terain') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                            <label for="">Type Gazon:</label>
                            <select name="gazon" class="form-control rectangular-input">
                                <option value="" ></option>
                                <option value="Artificielle">Artificielle</option>
                                <option value="Naturel">Naturel</option>
                                <option value="autre">autre</option>
                            </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Largeur(m):</label>
                                    <input type="number" id="numbo1" name="larg" class="form-control rectangular-input" placeholder="optionel">
                                </div>
                                <div class="col-6">
                                    <label for="">Longueur(m):</label>
                                    <input type="number" id="numbo2" name="long" class="form-control rectangular-input" placeholder="optionel">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Description:</label>
                                <textarea name="descript" id="textarea"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Image de Terain:</label>
                                <input type="file" name="image" class="form-control rectangular-input">
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
        <form id="deleteModalForm" method="POST">
          @csrf
          @method('DELETE')
         
          <div class="modal-body">
              <h6>Est ce que vous etes sure de supprimmer ce Terain?</h6>
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
                <h3 class="modal-title fs-5" id="exampleModalLabel">Modifier Information Terain</h3>
            </div>
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" id="Editnom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                            <label for="">Type Gazon:</label>
                            <select name="gazon" id="Editgazon" class="form-control rectangular-input">
                                <option value="" ></option>
                                <option value="Artificielle">Artificielle</option>
                                <option value="Naturel">Naturel</option>
                                <option value="autre">autre</option>
                            </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Largeur(m):</label>
                                    <input type="number" id="numbo3" name="larg" class="form-control rectangular-input" placeholder="optionel">
                                </div>
                                <div class="col-6">
                                    <label for="">Longueur(m):</label>
                                    <input type="number" id="numbo4" name="long" class="form-control rectangular-input" placeholder="optionel">
                                </div>
                                <p id="EditSurf"></p>
                            </div>
                            <div class="mb-3">
                                <label for="">Description:</label>
                                <textarea name="descript" id="textarea" class="descri"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Modifier Image de Salle(optionel):</label>
                                <input type="file" name="image" class="form-control rectangular-input">
                            </div>

                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                    </div>
            </form>
        </div>
    </div>
</div>
{{-- end edit-materiel-modal --}}






<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                @foreach ($myTerain as $data)
                    @if (session('EditTerainStatus'))
                    <div class="alert alert-success">
                        {{ session('EditTerainStatus') }}
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                <div class="row">
                    <div class="col-6">
                        <h6><button type="button" class="btn btn-sm btn-primary float-left"  data-bs-toggle="modal" data-bs-target="#addModal" >+</button>
                            Terains</h6>

                        <p><strong>Nom : </strong>{{ $data->nom }}</p>
                        <p><strong>Surface : </strong>{{ $data->surface }}</p>
                        <p><strong>Type Gason : </strong>{{ $data->gazon }}</p>
                        <p><strong>Description : </strong>{{ $data->description }}</p>
                        <button type="button" class="btn btn-sm btn-primary float-center editModal"  data-bs-toggle="modal" data-bs-target="#editModal" value="{{$data->id}}" >Modfier</button>
                        <button type="button" class="btn btn-sm btn-danger float-center deletebtn"  data-bs-toggle="modal" data-bs-target="#deletModal" value="{{$data->id}}" >Supprimer</button>
                        
                    </div>
                    <div class="col-6 text-center">
                        <img src="{{ asset("myImg/terains/".$data->image) }}" width="100%" height="80%" alt="">
                    </div>
                </div>

            </div>

            @endforeach
            
        </div>
        <div>{{ $myTerain->links() }}</div>
    </div>
</div>

@endsection

@section('scripts')


<script>
    document.getElementById('numbo1').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });
    document.getElementById('numbo2').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });
    document.getElementById('numbo3').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });
    document.getElementById('numbo4').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });

    $(document).ready(function () {

        $('.deletebtn').click(function () {
            var terainlId = $(this).val();
            var url = "{{ url('/delete-terain/id=') }}" + terainlId;
            $('#deleteModalForm').attr('action', url);
        });

        $('.editModal').click(function () {
            var terainId = $(this).val();
            console.log('terainId',terainId);
            var url = "{{ url('/edit-terain/id=') }}" + terainId;
            $.ajax({
                type:'get',
                url:'{{ URL::to('get_terain_edited_data') }}',
                data:{'terainId':terainId},
                success:function(response){
                    $('#Editnom').val(response.nom);
                    $('#Editgazon').val(response.gazon);
                    $('#EditSurf').html(response.surface);
                    $('.descri').html(response.descript);
                    

                }
            });
            $('#editModalForm').attr('action', url);
        });
    });
</script>

    
@endsection
