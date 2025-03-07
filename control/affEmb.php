<?php

function affEm($emballage) {
    // Préparer la condition pour la requête SQL
    $condition = "idEm = $emballage"; // Remplacer avec la condition appropriée

    // Récupérer les données
    $donneesPoste = recupDon('emballage', $condition);

    if ($donneesPoste) {
        foreach ($donneesPoste as $post) {
            $embTxt = $post['libelleEm'];

            echo $embTxt;
        }
    } else {
        // Aucun poste trouvé
        echo "Aucun contenant trouvé pour l'identifiant fourni.\n";
    }
}
