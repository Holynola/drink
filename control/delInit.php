<?php

include 'dbConf.php';
include 'sumAll.php';

if (isset($_GET['idSt']) && ($_GET['idB'])) {
    
    $idSt = $_GET['idSt'];
    $idB = $_GET['idB'];
    $qte = $_GET['qte'];
    $service = $_SESSION['service'];

    // vérification du stock entrée et vendu
    $conSt = "BoissonSt = $idB AND serviceSt = $service";
    $stock = sumDon('stock', 'qteSt', $conSt);

    $conPr = "boissonPr = $idB AND servicePr = $service";
    $vendu = sumDon('produit', 'qtePr', $conPr);

    $etat = $stock - $vendu;

    if ($etat >= $qte) {
        // Suppression de la ligne
        $requete = "DELETE FROM stock WHERE idSt = :idSt";
        $stmt = $bdd->prepare($requete);
        $stmt->bindParam(':idSt', $idSt);

        try {
            $stmt->execute();
    
            $message = "Le stock a été supprimée avec succès.";
            $url = '../pages/stocks.php?msg=' . urldecode($message);
            header("Location: " . $url);
        } catch (PDOException $e) {
            $mess = "Erreur ! Veuillez réessayer plus tard";
            $urls = '../pages/stocks.php?msg=' . urldecode($mess);
            die("Error executing SQL query: " . $e->getMessage());
        }
    
    } else {
        $message = "Le stock ne peut être supprimé car il est déjà vendu ou une partie l'est déjà.";
        $url = '../pages/stocks.php?msg=' . urldecode($message);
        header("Location: " . $url);
    }

} else {
    header("Location: ../pages/stocks.php");
    exit;
}