<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('myImg/logo.png') }}" width="40" height="40" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <form class="d-flex transparent-form">
        <input class="form-control me-sm-2 transparent-input" type="search" placeholder="recherche">
      </form>
      <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Je réserve</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/userReserveTerain') }}">Terain</a>
            <a class="dropdown-item" href="{{ url('/userReserveMateriel') }}">Matériel</a>
            <a class="dropdown-item" href="{{ url('/userReserveSalle') }}">Salle</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/mesreservations') }}">Mes réservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/mesnotifications/do='.session('user_id')) }}">Notifications</a>
        </li>
        <li class="nav-item dropdown" style="margin-right: 100px;">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ session('prenom') }}</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/monprofil/id='.session('user_id')) }}">Mon profil</a>
            <a class="dropdown-item" href="{{ url('/changepassword') }}">Changer Password</a>
            <a class="dropdown-item" href="{{ url('/deconexion') }}">Déconexion</a>
          </div>         
        </li>



      </ul>

    </div>
  </div>
</nav>