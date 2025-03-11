<?php

include 'dbConf.php';
include 'mttConv.php';

if (isset($_POST['getName']) && ($_POST['qte']) && ($_POST['prixa'])) {

    // Conversion du prix en numérique
    $prixa = $_POST['prixa'];
    $prixaSt = mttConversion($prixa);

    $serviceSt = $_SESSION['service'];
    $BoissonSt = $_POST['getName'];
    $qteSt = $_POST['qte'];
    $venduSt = 0;
    $savebySt = $_SESSION['idUser'];
    $datesaveSt = date('Y-m-d H:i:s');

    $sql = "INSERT INTO stock (serviceSt, BoissonSt, qteSt, venduSt, cmdSt, nbrebtleSt, nbrecarsSt, prixcSt, prixaSt, savebySt, datesaveSt) VALUES (:serviceSt, :BoissonSt, :qteSt, :venduSt, NULL, NULL, NULL, NULL, :prixaSt, :savebySt, :datesaveSt)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceSt', $serviceSt);
    $stmt->bindParam(':BoissonSt', $BoissonSt);
    $stmt->bindParam(':qteSt', $qteSt);
    $stmt->bindParam(':venduSt', $venduSt);
    $stmt->bindParam(':prixaSt', $prixaSt);
    $stmt->bindParam(':savebySt', $savebySt);
    $stmt->bindParam(':datesaveSt', $datesaveSt);

    try {
        $stmt->execute();
        
        $message = "Votre stock a bien été enregistré.";
        $url = "../pages/stocks.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/stocks.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/stocks.php");
    exit;
}    
