<?php

function affService($service) {
    
    $condition = "idW = $service";

    // Récupérer les données des services
    $donneesWork = recupDon('work', $condition);

    // Vérifier si des services ont été trouvés
    if ($donneesWork) {
        // Parcourir les services trouvés
        foreach ($donneesWork as $work) {
            $workTxt = $work['libelleW'];
            echo $workTxt;
        }
    } else {
        // Aucun poste trouvé
        echo "Aucun poste trouvé pour les identifiants fournis.\n";
    }
}
