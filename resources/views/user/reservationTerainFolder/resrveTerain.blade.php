@extends('layout.layout')

@section('styl')
  <style>



  </style>

@endsection


@section('content')

  <h5>Terain_Foot_Ball Réservation</h5>
  <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;"></div>
  </div>
  </br>


  {{--  --}}
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      @foreach ($mes_terain as $terain)
      <div class="carousel-item active">
        <a href="{{url('/next_to_reservation_terain/id='.$terain->id)}}">
        <img src="{{ asset('myImg/terains/'.$terain->image) }}" width="100%" height="300px" class="d-block w-100" alt="...">
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


@endsection


@section('scripts')
 
@endsection