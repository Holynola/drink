<?php

// Récupération de l'ID de la ldernière ligne de la table 'vente'
$sqlV = "SELECT idV FROM vente ORDER BY idV DESC LIMIT 1";
$stmV = $bdd->prepare($sqlV);
$stmV->execute();
$vente = $stmV->fetchColumn(); // ID Vente

// Récupérer les lignes
$lignesJson = $_POST['lignes'];
$lignes = json_decode($lignesJson, true);

if ($lignes !== false) {
    $tabAsk = [];
    foreach ($lignes as $ligne) {
        $tabAsk[] = [
            'boissonId' => $ligne['boissonId'],
            'boissonText' => $ligne['boissonText'],
            'choix' => $ligne['choix'],
            'prix' => $ligne['prix'],
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

    // Produit
    $boissonPr = $ligne['boissonId'];
    $typePr = $ligne['choix'];
    $qtePr = $ligne['quantite'];
    $prixvPr = $ligne['montant'];

    addProduit($vente, $boissonPr, $typePr, $qtePr, $prixvPr);
}