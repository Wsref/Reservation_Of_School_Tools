@extends('layouts.master')

@section('title')
    Admin_app_profil
@endsection

@section('style')

<style>
    .rectangular-input{
        border-radius: 0px;
    }

</style>

@endsection

@section('content')
<div class="row">
    <div class="col-2">

    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4"><a href="{{ url('/adminProfile/adm='.session('admin_id')) }}"><small>.retour</small></a></div>
                    @if (session('PassStat'))
                    <div class="alert alert-warning">
                        {{ session('PassStat') }}
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body text-center">
                <form action="{{ url('/change_admin_password/adm='.session('admin_id')) }}" method="POST" onsubmit="return validForm()">
                    @csrf
                
                    <div class="">
                        <label for="">Ancien mot de passe</label></br>
                        <input type="text" name="ancPass" id="ancienps" class="form-control rectangular-input" required>
                    </div>
                    <div class="">
                        <label for="">Nouveau mot de passe</label></br>
                        <input type="text" name="nvPass" id="nouvps"  class="form-control rectangular-input" placeholder="plus que 8 caractere" required>
                    </div>
                    
                    
                    </br>
                    <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-2">

    </div>
</div>

@endsection

@section('scripts')
<script>
    function validForm() {
        var InputValAnps = document.getElementById('ancienps').value;
        var InputValNvps = document.getElementById('nouvps').value;
        if ((InputValAnps.length < 8) || (InputValNvps.length < 8) ) {
            return false;
        }

        return true;
    }
</script>
    
@endsection