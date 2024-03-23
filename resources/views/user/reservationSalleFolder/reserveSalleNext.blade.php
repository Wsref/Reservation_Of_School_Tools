@extends('layout.layout')


@section('styl')

  <link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker.min.css') }}">
  {{-- jqueru ui for datepicker --}}
  <link rel="stylesheet" href="{{ asset('demo/jquery-ui.css') }}">

  
@endsection


@section('content')


  <form action="{{ url('/userReserveSalle/jereserve/id='.$id.'&id2='. session('user_id')) }}" method="POST">
    @csrf
    <fieldset>
      <h5>Salle Réservation</h5>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;"></div>
      </div>
      </br>
      <div class="form-group">
        <label for="exampleInputEmail1" class="form-label mt-4">Jour vous souhaitez</label>
        <input type="text" class="form-control" name="dateR" id="date"  placeholder="Choisir le jour" required>
      </div>
      <div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">De</label>
        <select class="form-select" name="heureDe" id="heureDe" required>
          <option value="" disabled selected>choisir...</option>
        </select>
      </div>
      <div class="form-group">
          <label for="exampleSelect1" class="form-label mt-4">A</label>
          <select class="form-select" name="heureA" id="heureA" required>
            <option value="" disabled selected>choisir...</option>
          </select>
        </div>
    </fieldset>
    <br>
    <button type="submit" class="btn btn-primary">Reserve</button>
  </form>


@endsection

@section('scripts')

{{-- jqueru ui for datepicker --}}
<script src="{{ asset('demo/js/jquery-ui.js') }}"></script>

<script>

$('#date').datepicker({
  autoclose:true,
  dateFormat:'yy-mm-dd',
  minDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
  beforeShowDay: function(date) {
      var curentDay = new Date();
      var check_availableDays = (date >= curentDay);
      var check_if_is_today = date.getDate() === curentDay.getDate() &&
                              date.getMonth() === curentDay.getMonth() &&
                              date.getFullYear() === curentDay.getFullYear();
  
      return [check_availableDays || check_if_is_today , ''];

  },
  onSelect: function(dateText, inst) {
      console.log('Selected date:', dateText);
      $.ajax({
          type:'get',
          url:'{{URL::to('retrieve_salle_heureDe_reserv')}}',
          data:{ 'dateR':dateText,'salle_id':{{ $id }} },
          success:function(response){
              $('#heureDe').html(response.heureDe);
              console.log('heureDe',response.heureDe);
              $('#heureDe').on('input',function(){
                  $heureDe_chosed = $(this).val();
                  retrieveHeureA($heureDe_chosed,response.heureDeTable);
              });
          }
      });

  }

})

function retrieveHeureA(heureDe,heureDeTable){
    $.ajax({
      type :'get',
      url :'{{URL::to('retrieve_salle_heureA_reserv')}}',
      data :{ 'heureDe':heureDe,'heureDeTable':heureDeTable },
      success : function(response){
        $('#heureA').html(response.heureA);
      }
    });
}


</script>
    

@endsection