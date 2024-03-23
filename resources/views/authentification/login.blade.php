<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="{{ asset('demo/bootstrapBootswatch.min.css') }}" rel="stylesheet" crossorigin="anonymous">
  <style>
    .container{
        padding-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8 text-center">
            <div class="card bg-light mb-3">
                <div class="card-header"><h4>Platforme sportif ESTA</h4></div>
                <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ url('/Access_to_acount') }}" method="POST">
                            @csrf
                            <fieldset>
                                <div>
                                    <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                                    <input type="email" class="form-control form-control-sm" name="mymail" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    
                                </div>
                                <div>
                                    <label for="exampleInputPassword1" class="form-label mt-4">Mot de passe</label>
                                    <input type="password" class="form-control form-control-sm" name="mypass" id="exampleInputPassword1" placeholder="Mot de passe" autocomplete="off" required>
                                </div>
                                </br>
                                <button type="submit" class="btn btn-primary btn-sm">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-6">
                    </br>
                     <p>Si vous êtes étudiant à l'ESTA et que vous n'avez pas encore de compte sur la plateforme 
                        sportive qui vous permet de réserver le terrain principalement ou tout autre matériel dont 
                        vous avez besoin, vous pouvez même réserver une salle. Veuillez contacter l'administrateur de Platforme pour créer 
                        votre compte. Voici ses coordonnées :
                        {{ session('numeroAdmin') }}
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

<script src="{{ asset('demo/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('demo/js/jquery-3.7.1.js') }}"></script>
</html>
