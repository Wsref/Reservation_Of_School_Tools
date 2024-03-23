<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('demo/bootstrapBootswatch.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    {{-- <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* had css pour search bar khlaha transparent hitax kant black */
        .transparent-form {
          background-color: transparent;
          border: none;
        }
      
        .transparent-input {
          background-color: transparent;
          border: none;
          border-bottom: 1px solid #ccc; 
          color: white; 
          transition: background-color 0.3s; 
        }
      
        .transparent-input:focus {
          outline: none; 
          box-shadow: none;
          background-color: transparent; 
        }

    </style>
    <style>
      .custom-footer {
          background-color: #333;
          color: #fff;
      }
      .custom-footer a {
          color: #fff;
      }

      a {
      color: #048670; 
      
      }


  </style>


    @yield('styl')
    
</head>

<body>
    @include('layout.navbar')

    <div class="container py-4" id="globdiv">
      <div class="row">
          <div class="col-md-2 d-none d-md-block"> 
              @yield('contentLeftSide')
              <div class="card">
                  <div class="card-header">Navigation</div>
                  <div class="card-body">
                      <ul>
                          <li><a href="{{ url('/userReserveSalle') }}">Salles</a></li>
                          <li><a href="{{ url('/userReserveMateriel') }}">Materiéls</a></li>
                          <li><a href="{{ url('/userReserveTerain') }}">Terrains</a></li>
                        
                      </ul>
                  </div>
              </div>
          
              <div class="card mt-3">
                  <div class="card-header">événement récemment</div>
                  <div class="card-body">
                    @if (session('latestEvent'))
                        <p>{{'>> '. session('latestEvent') }}</p>
                    @else
                        <p>Rien rien.</p>
                    @endif
                               
                  </div>
              </div>
          </div>

          <div class="col-md-8 col-12 text-center">

              @yield('content')

          </div>

          <div class="col-md-2 d-none d-md-block"> 
              @yield('contentRightSide')
              <div class="card">
                  <div class="card-header">Annonces</div>
                  <div class="card-body">
                      <p>Pas d'annonce.</p>
                      
                  </div>
              </div>
          
              <div class="card mt-3">
                  <div class="card-header">Ressources utiles</div>
                  <div class="card-body">
                      <ul>
                          <li><a href="{{ url('/faqs') }}">FAQs</a></li>                          
                      </ul>
                  </div>
              </div>
          </div>       
    </div>
    <footer class="footer mt-5 custom-footer">
      <div class="container">
          <div class="row">
              <div class="col-md-1">                   
              </div>
              <div class="col-md-5">
                  <!-- Display the user's name -->
                  <h6>Connecté par<strong>{{' '.session('prenom') .' '. session('nom').'    ' }}</strong> <a href="{{ url('/deconexion') }}">(Déconexion)</a></h6>
                  <a href="{{ url('/') }}">Acceuil</a></br>
                  <p>Site officiel <a href="{{ url('/www.esta.ma') }}">ESTA</a></p></br></br>
                  <span>{{ date('Y'); }}</span>
              </div>
              <div class="col-md-5">
                  
              </div>
              <div class="col-md-1">                   
              </div>
          </div>
      </div>
  </footer>
</body>

<script src="{{ asset('demo/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('demo/js/jquery-3.7.1.js') }}"></script>

@yield('scripts')


</html>