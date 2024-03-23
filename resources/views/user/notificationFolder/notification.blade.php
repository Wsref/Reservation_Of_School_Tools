@extends('layout.layout')


@section('styl')

@endsection


@section('content')
  <h5>Notifications de l'administrateur</h5>

  </br>
  
    <div class="list-group" style="text-align: left";>
      @foreach ($notifications as $data)
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
        <div class="d-flex w-100 justify-content-between">
          <small>{{$data->admins->nom .' vous dit'}}</small>
          <small>{{$data->created_at}}</small>
        </div>
        <p class="mb-1">{{$data->message}}</p>
        
      </a>
      </br>
      @endforeach
    </div>

    
  

  
@endsection


@section('scripts')


@endsection