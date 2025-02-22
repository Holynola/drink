<?php

// Déconnexion automatique si session null
if (!isset($_SESSION['idUser'])) {
    header("Location: logout.php");
}

$_SESSION['logged_in'] = true;         // Indiquer que l'utilisateur est connecté
$_SESSION['last_activity'] = time();   // Enregistrer le temps actuel comme dernière activité

// Durée d'expiration (48 heures en secondes)
$expire_time = 172800;

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    
    // Vérifier si la variable de dernière activité est définie
    if (isset($_SESSION['last_activity'])) {
        
        // Calculer la durée d'inactivité
        $inactive_time = time() - $_SESSION['last_activity'];
        
        // Si la durée d'inactivité dépasse le temps limite, déconnecter
        if ($inactive_time > $expire_time) {
            // Détruire la session
            session_unset();     // Supprime toutes les variables de session
            session_destroy();   // Détruit la session
            header("Location: ../index.php");
            exit();
        }
    }

    // Mettre à jour la dernière activité
    $_SESSION['last_activity'] = time();

} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: ../index.php");
    exit();
}