@extends('layouts.master')

@section('title')
    Admin_app_users 
@endsection

@section('style')
    <style>
        #descrip {
            width: 100%;
            height: 100%;
            padding: 0.5em;
            box-sizing: border-box; 
        }
        .rectangular-input {
        border-radius: 0; 
        }
    </style>
@endsection

@section('content')

{{-- add-user-modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title fs-5" id="exampleModalLabel">Compte Utilisateur</h3>
          </div>
          <form action="{{ url('/createUserAcount') }}" method="POST">
              @csrf
                  <div class="modal-body">
                      
                          <div class="mb-3">
                          <label for="">Prénom:</label>
                          <input type="text" name="prenm" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Nom:</label>
                            <input type="text" name="nm" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Filiére:</label>
                            <input type="text" name="filir" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Année d'entrée:</label>
                            <input type="text" name="ann" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Email:</label>
                            <input type="email" name="eml" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Télephone:</label>
                            <input type="text" name="telp" class="form-control rectangular-input" required>
                          </div>
                          <div class="mb-3">
                            <label for="">Mot de passe:</label>
                            <input type="text" name="psswrd" class="form-control rectangular-input" required>
                          </div>
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-sm btn-primary">Créer compte</button>
                  </div>
          </form>
      </div>
  </div>
</div>
{{-- end add-user-modal --}}


   
<div class="modal fade text-center" id="notifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="notif_modal_form" method="POST">

        @csrf    
        <div class="modal-body ">
            <textarea name="message" id="descrip" cols="60" rows="5" required></textarea></br>
            <button type="submit" class="btn btn-sm btn-warning">Notifier</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6>
            <button type="button" class="btn btn-sm btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#exampleModal" >+</button>
            Utilisateurs</h6>
            <ul class="navbar-nav">
              <li class="nav-item">
                <input type="text" value=""  placeholder="Etudiant..." id="searc">
              </li>
            </ul>
       
        @if (session('notifySuccess'))
            
        <div class="alert alert-success">
          {{ session('notifySuccess') }}
          <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            
        @endif

        @if (session('createSuc'))
          <div class="alert alert-success">
            {{ session('createSuc') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>          
        @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                  <td><strong>Prénom</strong></td>
                  <td><strong>Nom</strong></td>
                  <td><strong>Filiére</strong></td>
                  <td><strong>Année d'entrée</strong></td>
                  <td><strong>Email</strong></td>
                  <td><strong>Télephone</strong></td>
                </thead>
                <tbody class="main-data">
                   
                    @foreach ($users as $user)
                         
                    <tr>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->filiere }}</td>
                        <td>{{ $user->anne }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telephon }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning notifybtn" data-bs-toggle="modal" data-bs-target="#notifModal" value="{{ $user->id }}">Notifier</button>                 
                        </td>
                    </tr>

                   
                    @endforeach   
                </tbody>
                <tbody id="search-content" class="searched-data">

                </tbody>
            </table>
            <div class="paginData">
                {{ $users->links() }}
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
      $('.notifybtn').click(function () {
          var userId = $(this).val();
          console.log('userid',userId);
          var url = "{{ url('/notify_Utilisateur/yxkpq=') }}" + userId + "&id2=" + {{ session('admin_id') }};
          $('#notif_modal_form').attr('action', url);
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
          $('.paginData').hide();

      }else{
          $('.main-data').show();
          $('.searched-data').hide(); 
          $('.paginData').show();  
      }

      $.ajax({
          type:'get',
          url:'{{URL::to('search-users')}}',
          data:{'search':$value},
          success:function(response){
              $('#search-content').html(response.data);
              var userIds = response.userIds;
                // console.log('userIds',userIds); //just pour tester car j'ai des problems ici
                userIds.forEach(urlid => {
                    $('.notifybtn').click(function () {
                    var url = "{{ url('/notify_Utilisateur/yxkpq=') }}" + urlid + "&id2=" + {{ session('admin_id') }};
                    $('#notif_modal_form').attr('action', url);
                     });
                });
          }
      });


  });


</script>


@endsection
