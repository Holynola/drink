<?php

include 'dbConf.php';

if (isset($_POST['four']) && ($_POST['contact'])) {

    $nomF = $_POST['four'];
    $localF = $_POST['localisation'];
    $numF = $_POST['contact'];
    $statutF = 'ON';
    $savebyF = $_SESSION['idUser'];
    $datesaveF = date('Y-m-d H:i:s');

    $sql = "INSERT INTO fournisseur (nomF, localF, numF, statutF, savebyF, datesaveF) VALUES (:nomF, :localF, :numF, :statutF, :savebyF, :datesaveF)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':nomF', $nomF);
    $stmt->bindParam(':localF', $localF);
    $stmt->bindParam(':numF', $numF);
    $stmt->bindParam(':statutF', $statutF);
    $stmt->bindParam(':savebyF', $savebyF);
    $stmt->bindParam(':datesaveF', $datesaveF);

    try {
        $stmt->execute();

        $message = "Le fournisseur a été enregistré.";
        $url = "../pages/suppliers.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;
    
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/suppliers.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/suppliers.php");
    exit;
}