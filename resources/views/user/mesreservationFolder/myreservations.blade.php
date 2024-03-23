@extends('layout.layout')


@section('styl')

@endsection


@section('content')
  <h5>Mes Réservation</h5>
  <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="Terain" autocomplete="off" checked>
      <label class="btn btn-outline-primary" for="btnradio1">Terain</label>
      <input type="radio" class="btn-check" name="btnradio" value="Materiel" id="btnradio2" autocomplete="off">
      <label class="btn btn-outline-primary" for="btnradio2">Materiel</label>
      <input type="radio" class="btn-check" name="btnradio" value="Salle" id="btnradio3" autocomplete="off">
      <label class="btn btn-outline-primary" for="btnradio3">Salle</label>

  </div>
  </br>  

  <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Objet</th>
          <th scope="col">Date</th>
          <th scope="col">De</th>
          <th scope="col">A</th>
          <th scope="col">Details</th>
          <th scope="col">Etat</th>
        </tr>
      </thead>
      <tbody id="myDataTable">

      </tbody>

    </table>
    <div id="pagData"></div>
  
@endsection


@section('scripts')
<script>
var filterType = $('input[name="btnradio"]:checked').val();
if (filterType){
  retrieveMesReservation(filterType);
}
// -------------------------------------------------------
$('input[type="radio"]').on('change', function() {
    var filterNameCheck = $('input[name="btnradio"]:checked').val();
    retrieveMesReservation(filterNameCheck);

});

function retrieveMesReservation(filtername){
    $.ajax({
      type : 'get',
      url : '{{ URL::to('/retrieve_mesReservation_data') }}',
      data : {'filterName':filtername,'userId':{{ session('user_id') }}},
      success : function(response){
        $('#myDataTable').html(response.mesreservationTable);
        $('#pagData').html(response.pagination);
        console.log('data',response.pagination);
      }
    });
 }



</script> 



@endsection