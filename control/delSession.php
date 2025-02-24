<?php
function deleteSessions($userId) {
    // Récupérer le chemin du répertoire des sessions
    $sessionPath = session_save_path();

    // Ouvrir le répertoire des sessions
    if ($handle = opendir($sessionPath)) {
        // Parcourir tous les fichiers de session
        while (false !== ($file = readdir($handle))) {
            // Ignorer les fichiers spéciaux . et ..
            if ($file != "." && $file != "..") {
                // Lire le contenu du fichier de session
                $sessionData = file_get_contents($sessionPath . '/' . $file);

                // Vérifier si l'ID utilisateur est présent dans le fichier de session
                if (strpos($sessionData, 'user_id|i:' . $userId . ';') !== false) {
                    // Supprimer le fichier de session
                    unlink($sessionPath . '/' . $file);
                }
            }
        }
        closedir($handle);
    }
}

?>