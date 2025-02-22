<?php

function affPoste($poste) {
    // Préparer la condition pour la requête SQL
    $condition = "idPo = $poste"; // Remplacer avec la condition appropriée

    // Récupérer les données des postes
    $donneesPoste = recupDon('poste', $condition);

    // Vérifier si des postes ont été trouvés
    if ($donneesPoste) {
        // Parcourir les postes trouvés
        foreach ($donneesPoste as $post) {
            // Extraire le libellé du poste
            $posteTxt = $post['libellePo']; // Remplacer avec le champ contenant le libellé

            // Afficher le libellé du poste
            echo $posteTxt;
        }
    } else {
        // Aucun poste trouvé
        echo "Aucun poste trouvé pour les identifiants fournis.\n";
    }
}
