<?php

// récupérer les stocks liés à la commande
$service = $_SESSION['service'];

$conS = "cmdSt = $idC AND serviceSt = $service";
$donS = recupDon('stock', $conS);

foreach ($donS as $sto) {
    $idB = $sto['BoissonSt'];
    $qte = $sto['qteSt'];

    // vérification du stock entrée et vendu
    $conSt = "BoissonSt = $idB AND serviceSt = $service";
    $stock = sumDon('stock', 'qteSt', $conSt);

    $conPr = "boissonPr = $idB AND servicePr = $service";
    $vendu = sumDon('produit', 'qtePr', $conPr);

    $etat = $stock - $vendu;

    if ($etat >= $qte) {
        $requete = "DELETE FROM stock WHERE cmdSt = :cmdSt";
        $stmt = $bdd->prepare($requete);
        $stmt->bindParam(':cmdSt', $idC);
        $stmt->execute();
    } else {
        $message = "La commande ne peut être supprimée car le stock d'une boisson a déjà été vendu.";
        $url = '../pages/cmdes.php?msg=' . urldecode($message);
        header("Location: " . $url);
        exit();
    }
}