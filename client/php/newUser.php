<?php
  require_once('user.php');
?>
<!DOCTYPE html>
<html class="h-100">

<head>
  <title>WebAurion++</title>
  <meta charset="utf-8">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  <link href="../../custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 justify-content-between">

  <header>
    <nav class="navbar text-bg-danger justify-content-center" >
      <div class="container-fluid">
        <button class="navbar-dark navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </button>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <hr>
          </div>

          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link" href=".php">
                  Accueil (SVG A INSÉRER)
                </a>
              </li>
            </ul>       
          </div>
        </div>

        <h3>AJOUT UTILISATEUR</h3>
        <div class="dropdown-center">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">NOM UTILISATEUR (FONCTION)</a>

          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="../../disconnect.php">Déconnexion
                <svg xmlns="http://www.w3.org/2000/svg" width="18%" height="18%" fill="currentColor" class="bi bi-box-arrow-right " viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <?php
  if(isset($_POST['add_user']))
    if(isset($_POST['btnradio']) && $_POST['btnradio'] == 'professeur'){
        if($_POST['new_mail'] == $_POST['new_mail_validation'] && $_POST['new_password'] == $_POST['new_password_validation']){
          try{
          $values = array(
            "mail" => $_POST['new_mail'],
            "name" => $_POST['new_last_name'],
            "surname" => $_POST['new_first_name'],
            "phone" => $_POST['new_phone'],
            "is_admin" => false
          );
          $teacher = new Teacher($values);              
          $user->addTeacher($teacher,$_POST['new_password']);
          echo '
        <div class="container">
          <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>  
            &nbsp;Professeur ajouté avec succès !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        ';
        }
        catch(Exception $e){
          echo '
          <div class="container">
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
              </svg>
                &nbsp;Erreur durant l\'ajout du professeur !
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>  
          ';
        }
      }
    } 
    if(isset($_POST['btnradio']) && $_POST['btnradio'] == 'eleve'){
      if(isset($_POST['new_student_id']) && $_POST['new_mail'] == $_POST['new_mail_validation'] && $_POST['new_password'] == $_POST['new_password_validation']){
          if(isset($_POST['new_class']) && get_class(unserialize($_POST['new_class'])) === "SchoolClass"){
            try{
            $studClass = unserialize($_POST['new_class']);
            $values = array(
              "mail" => $_POST['new_mail'],
              "name" => $_POST['new_last_name'],
              "surname" => $_POST['new_first_name'],
              "phone" => $_POST['new_phone'],
              "student_id" => $_POST['new_student_id'],
              "is_admin" => false
            );
            $student = new Student(array_merge($values, $studClass->getDbRow()));
            $success = $user->addStudent($student,$_POST['new_password']);
            echo '
        <div class="container">
          <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>  
            &nbsp;Étudiant ajouté avec succès !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
        ';
      }
      catch(Exception $e){
        echo '
        <div class="container">
          <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
              &nbsp;Erreur durant l\'ajout de l\'étudiant !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>  
        ';
      }
    }
  }
  }
  ?>

  <main>
    <div class="container">
      <div class="row">
        <form class="col-md-7 offset-md-3" method="post" action="admin_add_user.php">
          <div class="btn-group mt-3 mb-3 col-md-4 offset-md-3" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="eleve" autocomplete="off" checked>
            <label class="btn btn-outline-danger" for="btnradio1">éleve</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="professeur" autocomplete="off">
            <label class="btn btn-outline-danger" for="btnradio2">professeur</label>
          </div>
        
          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Nom</label>

            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Dupont" name="new_last_name">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Prénom</label>

            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Jean" name="new_first_name">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Téléphone</label>

            <div class="col-sm-8">
              <input type="num" class="form-control" placeholder="0123456789" name="new_phone">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Adresse mail</label>

            <div class="col-sm-8">
              <input type="email" class="form-control" placeholder="jean.dupont@messagerie.fr" name="new_mail">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label"> Confirmation Email</label>

            <div class="col-sm-8">
              <input type="email" class="form-control" placeholder="jean.dupont@messagerie.fr" name="new_mail_validation">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Mot de passe</label>

            <div class="col-sm-8">
              <input type="password" class="form-control" placeholder="motdepasse" name="new_password">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Confirmation du mot de passe</label>

            <div class="col-sm-8">
              <input type="password" class="form-control" placeholder="motdepasse" name="new_password_validation">
            </div>
          </div>

          <div class="mb-3 row" id="class">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Classe</label>

            <div class="col-sm-8">
              <select class="form-select" name="new_class">
                <?php
                  $classList = $user->listClasses();
                  foreach($classList as $schoolClass){
                    echo "<option value=" . serialize($schoolClass) . ">" . $schoolClass->print() . "</option>";
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="mb-3 row" id="student_id">
            <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">ID étudiant</label>

            <div class="col-sm-8">
              <input type="number" class="form-control" placeholder="" name="new_student_id">
            </div>
          </div>
          
          <script>
            document.getElementById("btnradio1").addEventListener('change', showClass);
            document.getElementById("btnradio2").addEventListener('change', showClass);
            function showClass() {
              document.getElementById("class").classList.toggle('d-none');
              document.getElementById("student_id").classList.toggle('d-none');
            }
          </script>

          <input class="btn text-bg-danger mt-3 col-md-4 offset-md-3" type="submit" value="Ajouter" name="add_user">
        </form>
      </div>
    </div>
  </main>

  <?php require_once('../../footer.php') ?>

</body>