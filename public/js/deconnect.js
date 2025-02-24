$(document).ready(function() {
    // Écouter le clic sur la balise <i> avec l'ID "logoutIcon"
    $('#log_out').click(function() {
        // Rediriger vers logout.php
        window.location.href = 'logout.php';
    });
});