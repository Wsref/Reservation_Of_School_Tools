@extends('layouts.master')

@section('title')
    Admin_app_materiel
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form action="{{ url('/update-materiel/vbgf=' . $edit_materiel->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="modal-body">
                            
                            <div class="mb-3">
                                <label for="">Nom:</label>
                                <input type="text" name="nom" class="form-control" value="{{ $edit_materiel->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Categorie:</label>
                                <select name="category" class="form-control">
                                    <option value="FootBall">FootBall</option>
                                    <option value="BasketBall">BasketBall</option>
                                    {{-- <option value="volley_ball">volley_ball</option> --}}
                                    <option value="Ping-Pong">Ping-Pong</option>
                                    <option value="autre">autre</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Quantite:</label>
                                <input type="number" name="quantite" class="form-control" value="{{ $edit_materiel->quantite }}">
                            </div>
                            <div class="mb-3">
                                <label for="">Image:</label>
                                <img src="{{ asset('uploads/imgs/' . $edit_materiel->image) }}"  height="100px"  alt="">
                                <input type="file" name="image" class="form-control">
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('/materiel_est') }}" class="btn btn-sm btn-secondary">Fermer</a>
                            <button type="submit" class="btn btn-sm btn-primary">Editer Matériel</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')

@endsection
