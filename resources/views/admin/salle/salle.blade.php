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
                <h3 class="modal-title fs-5" id="exampleModalLabel">Nouveau Salle</h3>
            </div>
            <form action="{{ url('/save-salle') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Capacité:</label>
                                <input type="number"  name="capacite" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Description:</label>
                                <textarea name="descript" id="textarea"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Image de Salle:</label>
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
        <form id="deleteModalForm" method="POST">
          @csrf
          @method('DELETE')
         
          <div class="modal-body">
              <h6>Est ce que vous etes sure de supprimmer cet Salle?</h6>
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
                <h3 class="modal-title fs-5" id="exampleModalLabel">Modifier Information Salle</h3>
            </div>
            <form id="editModalForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        
                            <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" id="Editnom" class="form-control rectangular-input" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Capacité:</label>
                                <input type="number" id="numbo2" name="capacite" class="form-control rectangular-input" required>
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
                @foreach ($mySalle as $data)
                    @if (session('EditSalleStatus'))
                    <div class="alert alert-success">
                        {{ session('EditSalleStatus') }}
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                <div class="row">
                    <div class="col-6">
                        <h6><button type="button" class="btn btn-sm btn-primary float-left"  data-bs-toggle="modal" data-bs-target="#addModal" >+</button>
                            Salles</h6>

                        <p><strong>Nom : </strong>{{ $data->nom }}</p>
                        <p><strong>Capacité : </strong>{{ $data->capacity }}</p>
                        <p><strong>Description : </strong>{{ $data->description }}</p>
                        <button type="button" class="btn btn-sm btn-primary float-center editModal"  data-bs-toggle="modal" data-bs-target="#editModal" value="{{$data->id}}" >Modfier</button>
                        <button type="button" class="btn btn-sm btn-danger float-center deletebtn"  data-bs-toggle="modal" data-bs-target="#deletModal" value="{{$data->id}}" >Supprimer</button>
                        
                    </div>
                    <div class="col-6 text-center">
                        <img src="{{ asset("myImg/salles/".$data->image) }}" width="100%" height="80%" alt="">
                    </div>
                </div>

            </div>

            @endforeach
            
        </div>
        <div>{{ $mySalle->links() }}</div>
    </div>
</div>

@endsection

@section('scripts')

<script>

    document.getElementById('numbo2').addEventListener('input', function(event) {
        if (this.value < 0) {
            this.value = ''; 
        }
    });

</script>


<script>

    $(document).ready(function () {

        $('.deletebtn').click(function () {
            var salleId = $(this).val();
            var url = "{{ url('/delete-salle/id=') }}" + salleId;
            $('#deleteModalForm').attr('action', url);
        });

        $('.editModal').click(function () {
            var salleId = $(this).val();
            console.log('salleId',salleId);
            var url = "{{ url('/edit-salle/id=') }}" + salleId;
            $.ajax({
                type:'get',
                url:'{{ URL::to('get_salle_edited_data') }}',
                data:{'salleId':salleId},
                success:function(response){
                    $('#Editnom').val(response.nom);
                    $('#numbo2').val(response.capacity);
                    $('.descri').html(response.descript);
                    

                }
            });
            $('#editModalForm').attr('action', url);
        });
    });
</script>


    
@endsection
