<?php

// Récupération de l'ID de la dernière ligne de la table 'commande'
$sqlC = 'SELECT idC FROM commande ORDER BY idC DESC LIMIT 1';
$stmC = $bdd->prepare($sqlC);
$stmC->execute();
$cmde = $stmC->fetchColumn(); // ID Commande

// Récupérer les lignes
$lignesJson = $_POST['lignes'];
$lignes = json_decode($lignesJson, true);

if ($lignes !== false) {
    $tabAsk = [];
    foreach ($lignes as $ligne) {
        $tabAsk[] = [
            'boissonId' => $ligne['boissonId'],
            'boissonText' => $ligne['boissonText'],
            'prix' => $ligne['prix'], // Prix du casier
            'quantite' => $ligne['quantite'],
            'montant' => $ligne['montant']
        ];
    }
} else {
    echo "Erreur lors de la récupération des données";
}

// Ajout à la table 'Stock'
$ligneCount = count($tabAsk);
for ($i = 0; $i < $ligneCount; $i++) {
    $ligne = $tabAsk[$i];

    $serviceSt; // Lieu de service
    $nbrebtleSt; // Nombre de bouteilles par casier

    // Boissons
    $idB = $ligne['boissonId']; // ID Boisson
    $conB = "idB = $idB";
    $donB = recupDon('boisson', $conB);
    foreach ($donB as $bs) {
        $serviceSt = $bs['serviceB'];
        $nbrebtleSt = $bs['nbreB'];
    }

    $nbrecarsSt = $ligne['quantite']; // Nombre de casiers
    $qteSt = $nbrecarsSt * $nbrebtleSt; // Nombre de bouteilles (Quantité)
    $prixcSt = $ligne['prix']; // Prix du casier

    // Enregistrer le stock
    addStock($serviceSt, $idB, $qteSt, $cmde, $nbrebtleSt, $nbrecarsSt, $prixcSt);
}