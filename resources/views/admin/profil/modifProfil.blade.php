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
                    <div class="col-8"><h6>Profile</h6></div>
                    <div class="col-4"><a href="{{ url('/adminProfile/adm='.session('admin_id')) }}"><small>.retour</small></a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/modifier_admin_Profil/adm='.session('admin_id')) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Prénom</label></br>
                            <input type="text" name="prenm" value="{{ $adminInfo['Adminprenom'] }}" class="form-control rectangular-input" required>
                        </div>
                        <div class="col-6">
                            <label for="">Nom</label></br>
                            <input type="text" name="nm" value="{{ $adminInfo['Adminnom'] }}" class="form-control rectangular-input" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Email</label></br>
                            <input type="email" name="mail" value="{{ $adminInfo['Adminemail'] }}" class="form-control rectangular-input" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Télephone</label></br>
                            <input type="text" name="telep" value="{{ $adminInfo['AdminTelephon'] }}" class="form-control rectangular-input" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Facebook</label>
                            <input type="text" name="fcbk" value="{{ $adminInfo['AdminFacebook'] }}" class="form-control rectangular-input">
                        </div>
                        <div class="col-6">
                            <label for="">Instagram</label>
                            <input type="text" name="insta" value="{{ $adminInfo['AdminInstagram'] }}" class="form-control rectangular-input">
                        </div>
                    </div>
                    
                    </br>
                    <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-2">

    </div>
</div>

@endsection

@section('scripts')

@endsection