@extends('layouts.master')

@section('title')
    Admin_app_reservation
@endsection
{{-- ---------------------------------------------------------- --}}
@section('style')
<style>
  
    #calendar {
      max-width: 1100px;
      margin: 0 auto;
    }
  
</style> 
@endsection
{{-- ---------------------------------------------------------- --}}
@section('content')

<div class="modal fade" id="infoModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title fs-5" id="exampleModalToggleLabel">Information sur Reservation</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
            <label for="">Etudiant</label>
            <h6 id="name"></h6>
            <label for="">Filiere</label><br>
            <h6 id="filiere" style="display: inline-block; margin: 0;"></h6>
            <h6 style="display: inline-block; margin: 0;">|</h6>
            <h6 id="anne" style="display: inline-block; margin: 0;"></h6>
            <h6 style="display: inline-block; margin: 0;"> année</h6><br>
            <label for="">Telephon</label>
            <h6 id="telephon"></h6>
            <label for="">Matériel reservé</label><br>
            <h6 id="materiel" style="display: inline-block; margin: 0;"></h6>
            <h6 style="display: inline-block; margin: 0;">|</h6>
            <h6 id="category" style="display: inline-block; margin: 0;"></h6><br>
            <label for="">Quantité</label>
            <h6 id="quantite"></h6>
        
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h6>Reservations Materiel</h6>
        </div>  
        <div class="card-body" >
          <div class="scrollable-div">
            <div id='calendar'></div> 
          </div>
          
        </div>  
      </div>
    </div>
</div>





@endsection
{{-- ---------------------------------------------------------- --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales-all.global.min.js"></script>
<script src="{{ asset('assets/reserveCalend/index.global.js') }}"></script>

<script>
  
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      // get current date bro
      var currentDate = new Date();
      var generetDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);
      //  get current date bro
      var calendar = new FullCalendar.Calendar(calendarEl, {
  
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'listDay,listWeek'
        },
        locale: 'fr',
        buttonText: {
          today: 'Aujourd\'hui',
          year: 'Année',
          month: 'Mois',
          week: 'Semaine',
          day: 'Jour',
        },
        views: {
          listDay: { buttonText: 'liste jour' },
          listWeek: { buttonText: 'liste semaine' }
        },
        initialView: 'listWeek',
        initialDate: generetDate,
        navLinks: true, 
        editable: true,
        dayMaxEvents: true,
        events :  {
          url: 'reservation_data_materiel',
          method: 'GET',
        },
        eventClick: function(info) {
        // eventClick begin
          info.jsEvent.preventDefault();
          var eventUrls = info.event.url;
          if(eventUrls)
          {
              if (!Array.isArray(eventUrls)) {
                eventUrls = [eventUrls];
              }
              eventUrls.forEach(function(eventUrl){
                  $.ajax({
                      url: eventUrl,
                      method: 'GET',
                      success: function(data) {
                        $('#infoModal').modal('show');
                        $('#name').html(data.name);
                        $('#filiere').html(data.filiere);
                        $('#anne').html(data.anne);
                        $('#telephon').html(data.telephon);
                        $('#materiel').html(data.materiel);
                        $('#category').html(data.category);
                        $('#quantite').html(data.quantite);
                      }
                  });
              });
          }
        // eventClick end
        }  
        
  
      });
      calendar.render();
      
    });
  
  </script>

@endsection
