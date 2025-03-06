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
    }
}