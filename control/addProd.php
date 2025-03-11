<?php

// Récupération de l'ID de la dernière ligne de la table 'inventory'
$sqlI = "SELECT idV FROM inventory ORDER BY idV DESC LIMIT 1";
$stmI = $bdd->prepare($sqlI);
$stmI->execute();
$vent = $stmI->fetchColumn(); // ID inventory

// Récupérer les lignes
$lignesJson = $_POST['lignes'];
$lignes = json_decode($lignesJson, true);

if ($lignes !== false) {
    $tabAsk = [];
    foreach ($lignes as $ligne) {
        $tabAsk[] = [
            'boissonId' => $ligne['boissonId'],
            'boissonText' => $ligne['boissonText'],
            'stockInitial' => $ligne['stockInitial'],
            'stockApresVente' => $ligne['stockApresVente'],
            'quantite' => $ligne['produitsVendus'],
            'montant' => $ligne['montant'],
            'consignation' => $ligne['consignation']
        ];
    }
} else {
    echo "Erreur lors de la récupération des données";
}

// Ajout à la table 'Produit'
$ligneCount = count($tabAsk);
for ($i = 0; $i < $ligneCount; $i++) {
    $ligne = $tabAsk[$i];

    $boissonPr = $ligne['boissonId']; // ID Boisson
    $qtePr = $ligne['quantite']; // Quantité
    $mttPr = $ligne['montant']; // Montant de vente

    $servicePr = $_SESSION['service'];

    if (($boissonPr !== null) && ($qtePr !== null) && ($mttPr !== null)) {
        // Enregistrer le produit
        addProduit($servicePr, $vent, $boissonPr, $qtePr, $mttPr);

        $conSt = "boissonSt = $boissonPr";
        $donSt = recupDon('stock', $conSt);

        foreach ($donSt as $stk) {

            if ($stk['qteSt'] > $stk['venduSt']) {
                $reste = $stk['qteSt'] - $stk['venduSt'];

                if ($reste >= $qtePr) {

                    $nvVendu = $qtePr;
                    $stock = $stk['idSt'];

                    // Modifier la quantité vendue dans la table Stock
                    if ($nvVendu > 0) {
                        updateStk($stock, $nvVendu);

                        // Calcul du montant d'achat
                        if ($stk['prixaSt'] == null) {

                            $prixa = $stk['prixcSt'] / $stk['nbrebtleSt'];

                            // Arrondir à la valeur multiple de 5 la plus proche
                            $prixaFr = round($prixa / 5) * 5;

                            // Montant d'achat
                            $mta = $nvVendu * $prixaFr;

                            // Enregistrement du bénéfice
                            addBenefice($servicePr, $vent, $boissonPr, $nvVendu, $mttPr, $mta);

                        } else {
                            $prixa = $stk['prixaSt'];

                            // Montant d'achat
                            $mta = $nvVendu * $prixa;

                            // Enregistrement du bénéfice
                            addBenefice($servicePr, $vent, $boissonPr, $nvVendu, $mttPr, $mta);
                        }
                    }

                    $qtePr = 0; // Mise à jour de qtePr pour la ligne suivante

                } else {
                    // Si la quantité vendue est supérieure au stock non vendu
                    $nvVendu = $reste;
                    $stock = $stk['idSt'];

                    // Modifier la quantité vendue dans la table Stock
                    if ($nvVendu > 0) {
                        updateStk($stock, $nvVendu);

                        // Calcul du montant d'achat
                        if ($stk['prixaSt'] == null) {

                            $prixa = $stk['prixcSt'] / $stk['nbrebtleSt'];

                            // Arrondir à la valeur multiple de 5 la plus proche
                            $prixaFr = round($prixa / 5) * 5;

                            // Montant d'achat
                            $mta = $nvVendu * $prixaFr;

                            // Enregistrement du bénéfice
                            addBenefice($servicePr, $vent, $boissonPr, $nvVendu, $mttPr, $mta);

                        } else {
                            $prixa = $stk['prixaSt'];

                            // Montant d'achat
                            $mta = $nvVendu * $prixa;

                            // Enregistrement du bénéfice
                            addBenefice($servicePr, $vent, $boissonPr, $nvVendu, $mttPr, $mta);
                        }
                    }

                    $newQte = $qtePr - $reste;
                    $qtePr = $newQte; // Mise à jour de qtePr pour la ligne suivante
                }
            }
        }
    }
}