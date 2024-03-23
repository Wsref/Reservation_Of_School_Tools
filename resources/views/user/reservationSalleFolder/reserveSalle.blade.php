@extends('layout.layout')

@section('styl')
  <style>

    /* caroussel css  */
    .carousel-item {
    position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.211); 
    }

    .carousel-item {
        border: 2px solid #ccc; 
        border-radius: 10px; 
        overflow: hidden; 
    }


  </style>

@endsection


@section('content')


  <h5>Salle Réservation</h5>
  <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;"></div>
  </div>
  </br>

  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      @foreach ($mes_salles as $salle)
      <div class="carousel-item active">
        <a href="{{url('/next_to_reservation_salle/id='.$salle->id)}}">
        <img src="{{ asset('myImg/salles/'.$salle->image) }}" width="100%" height="300px" class="d-block w-100" alt="...">
        </a>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  {{--  --}}
  
 

@endsection


@section('scripts')

@endsection