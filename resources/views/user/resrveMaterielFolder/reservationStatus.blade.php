@extends('layout.layout')

@section('styl')

@endsection


@section('content')


  <h5>Materiel Sportif Réservation</h5>
  <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{session('progress')}}" aria-valuemin="0" aria-valuemax="100" style="width: {{session('progress')}}%;"></div>
  </div>
  </br>
  @if(session('statusNV'))

      <div class="card text-white bg-warning mb-3 w-100">
          <div class="card-header">État de votre réservation</div>
          <div class="card-body">
            <h4 class="card-title">Réservation Réfusée</h4>
            <p class="card-text">{{session('statusNV')}} <small><a href="{{'/'}}"> retour home</a></small></p>
          </div>
      </div>  

  @endif
  @if(session('statusV'))

  <div class="card text-white bg-info mb-3 w-100">
      <div class="card-header">État de votre réservation</div>
      <div class="card-body">
        <h4 class="card-title">Réservation Bien reçu</h4>
        <p class="card-text">{{session('statusV')}} <small><a href="{{'/'}}"> retour home</a></small></p>
      </div>
  </div>  
            
  @endif


   
@endsection


@section('scripts')
    
@endsection
