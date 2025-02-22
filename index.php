<?php
    session_start();
    session_unset();     // Supprime toutes les variables de session
    session_destroy();
    
    include 'control/alert.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerens</title>
    <link rel="shortcut icon" href="src/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <?php include 'public/css/indexCss.php'; // Fichier Style ?>
</head>
<body>
    <header>
        <div class="log">
            <h1>Bienvenue au <span>KERENS</span></h1>
            
            <form action="control/session.php" method="post">
                <p>Identifiant</p>
                <input type="text" name="username" id="username" placeholder="Entrez votre identifiant" maxlength="30" autocomplete="off">

                <p>Mot de passe</p>
                <input type="password" name="password" id="password" placeholder="••••••••••••••••••••••••••" minlength="4"><br>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </header>
</body>
</html>