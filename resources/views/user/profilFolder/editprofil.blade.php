@extends('layout.layout')

@section('styl')
    
@endsection

@section('content')

<div class="card border-secondary mb-3">
    <div class="card-header">Modifier votre profil</div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                    <div>
                        <fieldset disabled="">
                        <label class="form-label" for="disabledInput">Prénom</label>
                        <input class="form-control form-control-sm" id="disabledInput" type="text" placeholder="{{ $profil_data['user_prenom'] }}" disabled="">
                        </fieldset>
                    </div>
                    <div>
                        <fieldset disabled="">
                        <label class="form-label" for="disabledInput">Nom</label>
                        <input class="form-control form-control-sm" id="disabledInput" type="text" placeholder="{{ $profil_data['user_nom'] }}" disabled="">
                        </fieldset>
                    </div>
                    <div>
                        <fieldset disabled="">
                        <label class="form-label" for="disabledInput">Année d'entrée</label>
                        <input class="form-control form-control-sm" id="disabledInput" type="text" placeholder="{{ $profil_data['user_annee'] }}" disabled="">
                        </fieldset>
                    </div>
            </div>
            <div class="col-6">
                <div>
                    <fieldset disabled="">
                    <label class="form-label" for="disabledInput">Catégorie d'étudiant</label>
                    <input class="form-control form-control-sm" id="disabledInput" type="text" placeholder="{{ $profil_data['user_category'] }}" disabled="">
                    </fieldset>
                </div>
                <form action="{{ url('/saveChangeProfil/id='. session('user_id')) }}" method="POST">
                    @csrf
                    <div>
                        <label class="form-label" for="inputDefault">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" value="{{ $profil_data['user_email'] }}" id="inputDefault" required>
                    </div>
                    <div>
                        <label class="form-label" for="inputDefault">Téléphone</label>
                        <input type="text" class="form-control form-control-sm" name="telephone" value="{{ $profil_data['user_telephone'] }}" id="inputDefault" required>
                    </div>
                    </br>
                    <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                </form>
            </div>
            
        </div>

    </div>
</div>

@endsection



@section('scripts')
    
@endsection
