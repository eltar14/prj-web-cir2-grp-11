<?php
  require_once('User.php');
?>
<!DOCTYPE html>
<html class="h-100">

<head>
  <title>Création d'un compte</title>
  <meta charset="utf-8">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link href="../../custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 justify-content-between">

  <header>
    <nav class="navbar colorPurple justify-content-center" >
      <div class="container-fluid justify-content-center">
        <h2>CRÉATION DU COMPTE</h2>
      </div>
    </nav>
  </header>

  <?php
  if(isset($_POST['addUser'])){
        if(strcmp($_POST['email'],$_POST['emailConfirmation']) == 0 && strcmp($_POST['password'], $_POST['passwordConfirmation']) == 0 && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['birthDate'])){  
        $response = User::addUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['birthDate'], $_POST['password']);
          switch ($response){
            case "ok":
            echo '
              <div class="container">
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </svg>  
                  &nbsp;Compté créé avec succès !
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
              ';  
              header('Location: ../accueil.php');
              break;
            case "error":
              echo '
              <div class="container">
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                  </svg>
                    &nbsp;Erreur durant la création de votre compte :( !
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>  
              ';
              break;
            case "email already exists":
              echo '
              <div class="container">
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                  </svg>
                    &nbsp;Une adresse email est déjà liée à ce compte !
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>  
              ';
              break;
          }
      }
  }
  ?>

  <main>
    <div class="container">
      <div class="row">
        <form class="col-md-7 offset-md-3" method="post" action="">
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Nom</label>

            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Dupont" name="name">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Prénom</label>

            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Jean" name="surname">
            </div>
          </div>

          <div class="input-group mb-3">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Date de naissance</label>

            <label for="date" class="col-1 col-form-label">Date</label>
              <div class="col-sm-8">
                <div class="input-group date" id="datepicker">
                  <input type="date" class="form-control" id="date" name="birthDate"/>
                  <span class="input-group-append">
                  </span>
                </div>
              </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Adresse mail</label>

            <div class="col-sm-8">
              <input type="email" class="form-control" placeholder="jean.dupont@messagerie.fr" name="email">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label"> Confirmation Email</label>

            <div class="col-sm-8">
              <input type="email" class="form-control" placeholder="jean.dupont@messagerie.fr" name="emailConfirmation">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Mot de passe</label>

            <div class="col-sm-8">
              <input type="password" class="form-control" placeholder="motdepasse" name="password">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Confirmation du mot de passe</label>

            <div class="col-sm-8">
              <input type="password" class="form-control" placeholder="motdepasse" name="passwordConfirmation">
            </div>
          </div>

          <input class="btn colorDarkPurple mt-3 col-md-4 offset-md-3" type="submit" value="Ajouter" name="addUser">
        </form>
      </div>
    </div>
  </main>

  <footer class="footer colorDarkPurple py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <hr>
          <small>© LE BOULCH Antoine, PAITIER Mathias, LE GOFF Quentin</small>
        </div>
      </div>
    </div>
  </footer>
</body>