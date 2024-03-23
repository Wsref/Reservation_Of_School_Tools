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
                    <div class="col-4"><a href="{{ url('/modif_admin_page/adm='.session('admin_id')) }}"><small>.modifier les données</small></a></div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Prénom</label></br>
                            <p>{{ $adminInfo['Adminprenom'] }}</p>
                        </div>
                        <div class="col-6">
                            <label for="">Nom</label></br>
                            <p>{{ $adminInfo['Adminnom'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Email</label></br>
                            <p>{{ $adminInfo['Adminemail'] }}</p>
                        </div>
                        <div class="col-6">
                            <label for="">Télephone</label></br>
                            <p>{{ $adminInfo['AdminTelephon'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Facebook</label>
                            <p>{{ $adminInfo['AdminFacebook'] }}</p>
                        </div>
                        <div class="col-6">
                            <label for="">Instagram</label>
                            <p>{{ $adminInfo['AdminInstagram'] }}</p>
                        </div>
                    </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-5">
                        <label for="">Modifier Mot de passe</label>
                        <a href="{{ url('/changerPasswordPage') }}">.go</a>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">

    </div>
</div>

@endsection

@section('scripts')

@endsection