@extends('layouts.master')

@section('title')
    Admin_app_evenments
@endsection

@section('style')
    <style>
        .rectangular-input{
            border-radius: 0px;
        }
        #descrip {
            width: 100%;
            height: 100%;
            padding: 0.5em;
            box-sizing: border-box; 
        }
    </style>
@endsection


@section('content')


{{-- delet-confirmation-modal --}}
<div class="modal fade" id="delEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <form id="delete_modal_form" method="POST">
          @csrf
          @method('DELETE')
         
          <div class="modal-body">
              <h6>Est ce que vous etes sure de supprimmer cet évenement?</h6>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-sm btn-danger">Oui</button>
          </div>
        </form>
      </div>
    </div>
</div>

{{-- end delet-confirmation-modal --}}


<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h6>Evenements</h6>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <input type="text" value=""  placeholder="Evenement..." id="searc">
                    </li>
                </ul>
                @if (session('eventDel'))
                <div class="alert alert-success">
                    {{ session('eventDel') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="card-body main-data">
                @foreach ($myEvents as $event)
                    
               
                
                    <div class="card mb-3 text-center">
                        
                        
                        <a href="#" class="open-modal" data-bs-toggle="modal" data-bs-target="#delEventModal" data-value="{{ $event->id }}"><p class="card-header"><strong>{{ $event->titre }}</strong></p></a>
                        
                            <div class="card-body">
                            
                            <p class="card-title"><strong>{{$event->admins->nom}}</strong></p>
                            <p class="card-subtitle text-muted">{{$event->description}}</p>
                            
                            </div>
                            
                            <img src="{{ asset("myImg/evenments/".$event->image) }}" height="200px" width="100%" alt="">
                            <div class="card-body">
                            <p class="card-text"></p>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">#{{$event->tags}}</li>
                            </ul>
                            <div class="card-footer text-muted">
                            Difusé le {{ $event->date_diffus }} a {{ $event->time_diffus }}
                            </div>         
                        
                    </div>
                
                @endforeach
                <div>{{$myEvents->links()}}</div>
            </div>
            <div class="card-body searched-data" id="search-content">
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h6>Difusé un évenement</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/add_event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label for="">Titre</label></br>
                        <input type="text" name="titr" class="form-control rectangular-input" required>
                    </div>
                    <div class="mb-1">
                        <label for="">Description</label></br>
                        <textarea name="descrip" id="descrip" class="" cols="70" rows="5"></textarea> 
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tag#</label>
                            <input type="text" name="tag" class="form-control rectangular-input">
                        </div>
                        <div class="col-6">
                            <label for="">Link</label>
                            <input type="text" name="lin" class="form-control rectangular-input">
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="">Image</label></br>
                        <input type="file" name="image" class="form-control rectangular-input" required>
                    </div>
                    
                    </br>
                    <button type="submit" class="btn btn-sm btn-primary">Difuser</button>
                </form>
            </div>
        </div>

    </div>


</div>
    
@endsection


@section('scripts')


<script>
  document.querySelectorAll('.open-modal').forEach(function(element) {
    element.addEventListener('click', function(event) {
      var eventId = this.getAttribute('data-value');
      var url = "{{ url('/delete_event/id=') }}" + eventId;
      $('#delete_modal_form').attr('action', url);
    });
  });
</script>




<script>
  $('#searc').on('keyup',function()
  {
      
      $value = $(this).val();

      if($value){
          $('.main-data').hide();
          $('.searched-data').show();
          

      }else{
          $('.main-data').show();
          $('.searched-data').hide(); 
          
      }

      $.ajax({
          type:'get',
          url:'{{URL::to('search-event')}}',
          data:{'search':$value},
          success:function(response){
              $('#search-content').html(response.data);
                document.querySelectorAll('.open-modal').forEach(function(element) {
                element.addEventListener('click', function(event) {
                var eventId = this.getAttribute('data-value');
                var url = "{{ url('/delete_event/id=') }}" + eventId;
                $('#delete_modal_form').attr('action', url);
                });
                });
              console.log('data',response.data);            
               
          }
      });


  });

</script> 
@endsection