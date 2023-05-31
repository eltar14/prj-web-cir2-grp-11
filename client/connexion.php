<!DOCTYPE html>
<html class="h-100">

<head>
  <title>WebAurion++</title>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link href="../custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 justify-content-between">


  <header>
    <nav class="navbar colorPurple justify-content-center">
      <h3>PAGE D'AUTHENTIFICATION</h3>
    </nav>
  </header>


  <main>
    <div class="container">

      <div class="row text-center pb-5">
        <h2 id="title_welcome">Bienvenue, entrez vos identifiants pour vous connecter</h2>
      </div>
  
      <div class="row">
        <form class="col-4 offset-4 colorPurple p-5 rounded-5" method="post" action="../auth.php">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="jean.dupont@messagerie.fr" name="usernamx">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" name="password">
          </div>
          <input class="btn btn-light shadow mt-3" type="submit" value="Se connecter">
        </form>
      </div>


    </div>
  </main>

  <footer class="footer py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <hr>
          <small>© LE BOULCH Antoine, PAITIER Mathias, LE GOFF Quentin</small>
        </div>
      </div>
    </div>
  </footer>
</main>
