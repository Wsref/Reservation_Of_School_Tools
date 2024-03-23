<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
          Login Admin
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
        <link href="../assets/css/costum.css" rel="stylesheet" />
        <style>
        .recto{border-radius: 0px;}
        .container{padding-top: 100px;}
        .logBox{background-color: rgb(189, 187, 187);}
        </style>
      </head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8 text-center logBox">
            <div class="card bg-light mb-3">
                <div class="card-header"><h4>Platforme sportif ESTA(admin)</h4></div>
                <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ url('/Access_to_acount_admin') }}" method="POST">
                            @csrf
                            <fieldset>
                                <div>
                                    <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                                    <input type="email" class="form-control recto" name="mymail" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    
                                </div>
                                <div>
                                    <label for="exampleInputPassword1" class="form-label mt-4">Mot de passe</label>
                                    <input type="password" class="form-control recto" name="mypass" id="exampleInputPassword1" placeholder="Mot de passe" autocomplete="off" required>
                                </div>
                                </br>
                                <button type="submit" class="btn btn-primary btn-sm">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-4">
                        <p>Au cas ou vous avez oublié votre mot de passe il 
                            suffit de clicker sur le lien dessus pour le récuperer apartir de votre email
                            <a href="{{ url('/forget_admin_password') }}"><small>ici</small></a>
                        </p>
                    </div>
                </div>


                </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>

  </div>

</body>

<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
</html>
