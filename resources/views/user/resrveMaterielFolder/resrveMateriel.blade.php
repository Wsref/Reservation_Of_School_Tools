@extends('layout.layout')

@section('styl')

@endsection


@section('content')


  <form action="{{ url('/next_after_chosing_material') }}" method="POST">
      @csrf
      <fieldset>
        <h5>Materiel Sportif Réservation</h5>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;"></div>
        </div>

        <div class="form-group">
          <label for="exampleSelect1" class="form-label mt-4">Matériels disponible</label>
          <select class="form-select" name="materiel" id="materiel" required>
            <option value="" disabled selected>choisir...</option>
            @foreach ($materiels as $materiel)
              <option value="{{ $materiel->id }}">{{ $materiel->name }}</option>
            @endforeach
          </select>
        </div>
      </fieldset>
      <br>
      <button type="submit" class="btn btn-primary">Suivant</button>
    </form>


@endsection


@section('scripts')
  
@endsection