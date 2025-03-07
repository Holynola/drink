<?php

include 'dbConf.php';
include 'mttConv.php';

if (isset($_POST['mtt']) && ($_POST['madeby'])) {

    // Conversion de montant en numérique
    $mtt = $_POST['mtt'];
    $mttR = mttConversion($mtt);

    $serviceR = $_SESSION['service'];
    $ventR = $_GET['idV'];
    $madebyR = $_POST['madeby'];
    $datemadeR = $_POST['datemade'];
    $savebyR = $_SESSION['idUser'];
    $datesaveR = date('Y-m-d H:i:s');

    $sql = "INSERT INTO reglement (serviceR, ventR, mttR, madebyR, datemadeR, savebyR, pointR, datesaveR) VALUES (:serviceR, :ventR, :mttR, :madebyR, :datemadeR, :savebyR, NULL, :datesaveR)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceR', $serviceR);
    $stmt->bindParam(':ventR', $ventR);
    $stmt->bindParam(':mttR', $mttR);
    $stmt->bindParam(':madebyR', $madebyR);
    $stmt->bindParam(':datemadeR', $datemadeR);
    $stmt->bindParam(':savebyR', $savebyR);
    $stmt->bindParam(':datesaveR', $datesaveR);

    try {
        $stmt->execute();
        
        $message = "Votre règlement a bien été enregistré.";
        $url = "../pages/invents.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/invents.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/tdb.php");
    exit;
}