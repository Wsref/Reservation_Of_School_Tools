@extends('layout.layout')

@section('styl')

  <link rel="stylesheet" href="{{ asset('datePicker/css/bootstrap-datepicker.min.css') }}">
  {{-- jqueru ui for datepicker --}}
  <link rel="stylesheet" href="{{ asset('demo/jquery-ui.css') }}">
  
@endsection


@section('content')


  <form action="{{ url('/userReserveMateriel/jereserve/id=' . $matId.'&id2='. session('user_id')) }}" method="POST">
      @csrf
      <fieldset>
        <h5>Materiel Sportif Réservation</h5>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;"></div>
        </div>
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
        <div class="form-group">
          <label for="" class="form-label mt-4">Quantité <span class="badge rounded-pill bg-warning">max:<span id="mxQuant"></span></label>
          <input type="number" class="form-control" name="quantite" id="quantite"  placeholder="1 2 3..." required>
          <input type="hidden" name="mxQuant" id="copymxQuant">
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
    console.log('materielid:', {{ $matId }});

    $.ajax({
        type:'get',
        url:'{{URL::to('check_timeReserv')}}',
        data:{'dateResrv':dateText,'materielID':{{ $matId }}},
        success:function(response){
            $('#heureDe').html(response.heureDe);
            $('#mxQuant').html(response.myQuantite);

            
            $('#heureDe').on('input',function(){
              //console.log('HeureDeTable:', response.isNewDateR);
              //console.log('HeureDeTable:', response.heureDiponible);
              $heureDe = $(this).val();
              retrieveHeureA($heureDe,response.heureDiponible,response.isNewDateR);

            });
            

        }
    });

}
})


function retrieveHeureA(timeR,heureDeTable,isNewDateR,dateR){
  //console.log('noth',"nada");
  $.ajax({
    type:'get',
    url:'{{URL::to('retrieve_timeReservEnd')}}',
    data:{'heureDe':timeR,'heureDeTable':heureDeTable,'isNewDateR':isNewDateR,'materIld':{{ $matId }}},
    success:function(response){
      $('#heureA').html(response.heureA);

      $('#heureA').on('input',function(){
        $heuerA = $(this).val();
        retrieve_Final_Quantite(timeR,$heuerA,dateR,isNewDateR);
      });
      
      //console.log('error',response.error); just pour tester si data n'est pas valide asat hitax lgit maxakil hna
    },        
    error: function() {
       console.error('Error',"xihaja khra mahiyax");
    }
  });
}


function retrieve_Final_Quantite(heureDe,heureA,dateR,isNewDate){
  $.ajax({
    type : 'get',
    url : '{{URL::to('retieve_quantite')}}',
    data : {'heureDe':heureDe,'heureA':heureA,'dateR':dateR,'materiel_id':{{ $matId }},'isNewDate':isNewDate},
    success : function(response){
      $('#mxQuant').html(response.quantite);
      $('#copymxQuant').val(response.quantite);
      var test = document.getElementById('copymxQuant').value;
      console.log('quantite',test);

    },
    error : function(){
      console.log('error',"xiahja asat mahiyax");
    } 
  });

}






</script>


@endsection