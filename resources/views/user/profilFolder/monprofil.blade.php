@extends('layout.layout')
@section('styl')
    
@endsection

@section('content')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">{{ $profil_data['user_prenom'] }}  {{ $profil_data['user_nom'] }}</h4>
      <h6 class="card-subtitle mb-2 text-muted">{{ $profil_data['user_filiere'] }}</h6>
      <a href="{{ url('/editProfil/id='.session('user_id')) }}"><p class="text-primary">.modifier profil</p></a>
      <div class="row">
         <div class="col-6">
            <div>
                <fieldset>
                  <label class="form-label" for="readOnlyInput">Email</label>
                  <input class="form-control form-control-sm" id="readOnlyInput" type="text" placeholder="{{ $profil_data['user_email'] }}" readonly="">
                </fieldset>
              </div>
              <div>
                <fieldset>
                  <label class="form-label" for="readOnlyInput">Téléphone</label>
                  <input class="form-control form-control-sm" id="readOnlyInput" type="text" placeholder="{{ $profil_data['user_telephone'] }}" readonly="">
                </fieldset>
              </div>
         </div>
         <div class="col-6">
            <div>
                <fieldset>
                  <label class="form-label" for="readOnlyInput">Année d'entrée</label>
                  <input class="form-control form-control-sm" id="readOnlyInput" type="text" placeholder="{{ $profil_data['user_annee'] }}" readonly="">
                </fieldset>
              </div>
              <div>
                <fieldset>
                  <label class="form-label" for="readOnlyInput">Catégorie d'étudiant</label>
                  <input class="form-control form-control-sm" id="readOnlyInput" type="text" placeholder="{{ $profil_data['user_category'] }}" readonly="">
                </fieldset>
              </div>            
         </div>
      </div>

    </div>
  </div>
@endsection


@section('scripts')
    
@endsection
