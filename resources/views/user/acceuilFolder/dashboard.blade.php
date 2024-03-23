@extends('layout.layout')

@section('styl')

<style>
  .pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
    background-color: #f0f0f0; /* Change background color here */
  }
  .page-item {
    margin: 0 5px; /* Adjust margin as needed */
  }
  .page-link {
    text-decoration: none;
    color: black;
  }

</style>


@endsection


{{-- ------------------- --}}




{{-- --------------------- --}}

@section('content')
     

  <div class="card bg-light mb-3">
      <h3 class="card-header">Événements sportifs ESTA</h3>

        <div class="card-body">
          <h5 class="card-title">{{ $events[$nbr]->admins->prenom }}</h5>
          <h6 class="card-subtitle text-muted">{{ $events[$nbr]->description }}</h6>
        </div>
        <img src="{{ asset('myImg/evenments/'.$events[$nbr]->image) }}" height="200px" width="100%" alt="">
        <div class="card-body">
          <p class="card-text"></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="{{ $events[$nbr]->linkTotags }}">#{{ $events[$nbr]->tags }}</a></li>
        </ul>
        <div class="card-footer text-muted">
          {{ $events[$nbr]->date_diffus . ' | ' . $events[$nbr]->time_diffus }} 
        </div>    

      
      

  </div>
  <div class="">
    <ul class="pagination">
      <?php $i = 0; ?>
      @foreach ($events as $event)
      
      <li class="page-item">
        <a class="page-link" href="{{ url('/togetEvent/id='.$event->id.'&nb='.$i) }}" onclick="setActive(this)">{{ $event->titre }}</a>
      </li>
      <?php $i++; ?>
      @endforeach
    </ul>
  </div>
        
       




@endsection

@section('scripts')
<script>


  function setActive(element) {
    // Remove 'active' class from all links
    document.querySelectorAll('.page-link').forEach(link => {
      link.classList.remove('active');
    });
    // Add 'active' class to the clicked link
    element.classList.add('active');
  }
</script>
@endsection

