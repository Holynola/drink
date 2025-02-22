<?php

include 'dbConf.php';
include 'addHistory.php';

if (isset($_POST['username']) && ($_POST['password'])) {

    // Récupération des données du formulaire
    $identifiant = $_POST['username'];
    $motdepasse = $_POST['password'];

    // Vérification de la connexion
    $requete = $bdd->prepare('SELECT * FROM users WHERE userU = :identifiant');
    $requete->bindParam(':identifiant', $identifiant);
    $requete->execute();

    $resultat = $requete->fetch();

    if ($resultat && password_verify($motdepasse, $resultat['passU'])) {

        if ($resultat['statutU'] == 'ON') {

            if ($resultat['serviceU'] != 3) {
                $_SESSION["service"] = $resultat["serviceU"];
            }

            $_SESSION["idUser"] = $resultat['idU'];
            $_SESSION["titre"] = $resultat['titleU'];
            $_SESSION["nom"] = $resultat['nomU'];
            $_SESSION["prenoms"] = $resultat['prenomsU'];
            $_SESSION["poste"] = $resultat['posteU'];
            $_SESSION["contact"] = $resultat['contactU'];

            // Sauvegarde des données de connexion
            $userLg = $resultat['idU'];
            $posteLg = $resultat['posteU'];
            addLog($userLg, $posteLg);

            $url = "../pages/index.php";
            header("Location: " . $url);

        } elseif ($resultat['statutU'] == 'DEL') {

            $messag = "Votre compte a été supprimé. Veuillez contacter le Gestionnaire.";
            $ur = "../index.php?msg=" . urldecode($messag);
            header("Location:" . $ur);
        
        } else {

            $mess = "Votre compte est inactif. Veuillez contacter le Gestionnaire.";
            $urln = "../index.php?msg=" . urldecode($mess);
            header("Location:" . $urln);
        }

    } else {
        $message = "Erreur de connexion, vérifiez vos informations ou contacter le Gestionnaire.";
        $urls = "../index.php?msg=" . urldecode($message);
        header("Location:" . $urls);
    }

} else {
    header("Location: ../index.php");
}