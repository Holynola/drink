<?php

// Supprimer les bénéfices enregistrés
$requete = "DELETE FROM benefice WHERE ventBf = :ventBf";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':ventBf', $idV);
$stmt->execute();

// Récupérer les lignes de produits
$conP = "servicePr = $service AND ventPr = $idV";
$donP = recupDon('produit', $conP);

foreach ($donP as $pr) {
    $idPr = $pr['idPr'];
    $idB = $pr['boissonPr'];
    $qtePr = $pr['qtePr'];

    // Mise à jour de la table Stock
    $conS = "serviceSt = $service AND BoissonSt = $idB ORDER BY idSt DESC";
    $donS = recupDon('stock', $conS);

    foreach ($donS as $stk) {
        $stock = $stk['idSt'];
        $venduSt = $stk['venduSt'];

        if ($venduSt > 0) {

            if ($venduSt > $qtePr) {

                $nvVendu = $venduSt - $qtePr;
                updateStk($stock, $nvVendu);

                $qtePr = 0; // Mise à jour pour la ligne suivante

            } else {
                $nvVendu = 0;
                updateStk($stock, $nvVendu);

                $nvQte = $qtePr - $venduSt;
                $qtePr = $nvQte; // Mise à jour pour la ligne suivante
            }
        }
    }
}

// Supprimer les produits vendus
$requete = "DELETE FROM produit WHERE ventPr = :ventPr";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':ventPr', $idV);
$stmt->execute();