@extends('layout.layout')


@section('styl')
    
@endsection

@section('content')

<div class="card border-secondary mb-3">
    <div class="card-header">Modifier mot de passe</div>
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <form action="{{ url('/savechangepassword/id='.session('user_id'))}}" method="POST">
                    @csrf
                    <div class="has-danger">
                        <label class="form-label mt-4" for="inputInvalid">Mot de pass actuell</label>
                        <input type="text"  class="form-control form-control-sm is-invalid" name="actpass" id="inputInvalid" required>
                    </div>
                    <div class="has-danger">
                        <label class="form-label mt-4" for="inputInvalid">Mot de pass nouveau</label>
                        <input type="text"  class="form-control form-control-sm is-invalid" name="pass" id="inputInvalid" required>
                    </div>
                    </br>
                    <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                </form>
                
            </div>
            <div class="col-4">
                @if (session('NV'))
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Echec!</strong>{{session('NV')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection



@section('scripts')
    
@endsection