<?php

function affCont($contenant) {
    // Préparer la condition pour la requête SQL
    $condition = "idCt = $contenant"; // Remplacer avec la condition appropriée

    // Récupérer les données
    $donneesPoste = recupDon('contenant', $condition);

    if ($donneesPoste) {
        foreach ($donneesPoste as $post) {
            $contTxt = $post['libelleCt'];

            echo $contTxt;
        }
    } else {
        // Aucun poste trouvé
        echo "Aucun contenant trouvé pour l'identifiant fourni.\n";
    }
}
