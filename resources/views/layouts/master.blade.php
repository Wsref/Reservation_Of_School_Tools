
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="../assets/css/costum.css" rel="stylesheet" />

  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>.recto{border-radius: 0px;}</style>
  @yield('style')
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo">
        <a href="{{ url('/admin') }}" class="simple-text logo-mini">
          <img src="{{ asset('myImg/logo.png') }}" width="30px" height="30px" alt="">
        </a>
        <a href="{{ url('/admin') }}" class="simple-text logo-normal">
          Esport
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ url('/admin') }}" >
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li> 
              <a role="button" data-bs-toggle="dropdown" >
                <i class="now-ui-icons ui-1_calendar-60"></i>
                Etat Réservations
              </a>      
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/reservationTerain') }}">Terains</a>
                <a class="dropdown-item" href="{{ url('/reservationMateriel') }}">Matériels</a>
                <a class="dropdown-item" href="{{ url('/reservationSalle') }}">Salles</a>
              </div>      
          </li>
          <li>
            <a href="{{ url('/materiel_est') }}" >
              <i class="now-ui-icons shopping_box"></i>
              <p>Gestion Matériels</p>
            </a>
          </li>
          <li>
            <a href="{{ url('/terain_est') }}" >
              <i class="now-ui-icons sport_user-run"></i>
              <p>Gestion Terains</p>
            </a>
          </li>
          <li>
            <a href="{{ url('/salle_est') }}" >
              <i class="now-ui-icons tech_tv"></i>
              <p>Gestion Salles</p>
            </a>
          </li>
          <li>
            <a href="{{ url('/evenement_est') }}" >
              <i class="now-ui-icons sport_trophy"></i>
              <p>Gestion Evenements</p>
            </a>
          </li>
          <li class="">
            <a href="{{ url('/users_est') }}" >
              <i class="now-ui-icons users_single-02"></i>
              <p>Gestion Utilisateurs</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="{{ url('/deconexion') }}">
              <i class="now-ui-icons media-1_button-power"></i>
              <p>Déconexion</p>
            </a>
          </li>
        
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-info  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="{{ url('/admin') }}">EST AGADIR</a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control recto" placeholder="Recherche..." id="search">
              </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/adminProfile/adm='.session('admin_id') ) }}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>
                      <span class="d-lg-none d-md-block">{{ session('admin_prenom') }}</span>
                    </p>
                  </a>
                </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">

      </div> 
      <div class="content">



            @yield('content')
            {{-- Content dyalna ghaykon hna--}}



      </div>
    </div>
  </div>
  
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <script src="../assets/demo/demo.js"></script>

  @yield('scripts')
 
  
</body>

</html>