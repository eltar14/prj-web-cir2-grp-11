<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class='auth'>
    <form action='' method='post' class='main_content'>
        <h1>Connexion</h1>
        <p>
            <label>Email :
                <input type='text' name='username' class='form_box'>
            </label>
        </p>
        <p>
            <label>Mot de passe :
                <input type='password' name='password' class='form_box'>
            </label>
        </p>
        <p><input type='submit' class='btn'></p>
    </form>
    <div style='display: none'>
        <p>Pseudo ou mot de passe incorrects.</p>
    </div>
</div>

</body>
