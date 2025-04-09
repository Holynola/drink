<?php

include 'dbConf.php';
include 'mttConv.php';

if (isset($_POST['imageName']) && ($_POST['design'])) {

    // Prix de vente
    if (isset($_POST['prixv']) && ($_POST['prixv'] !== '')) {
        $prixv = $_POST['prixv'];
        $prixvB = mttConversion($prixv); // Prix de vente

        if ($prixvB == 0) {
            $prixvB = NULL;
        }
    } else {
        $prixvB = NULL;
    }

    // Nombre de bouteilles par kit
    if (isset($_POST['nbrekit']) && ($_POST['nbrekit'] !== '')) {
        $btekitB = $_POST['nbrekit'];
    } else {
        $btekitB = NULL; 
    }

    // Prix du kit
    if (isset($_POST['prixk']) && ($_POST['prixk'] !== '')) {
        $prixk = $_POST['prixk'];
        $prixkitB = mttConversion($prixk);

        if ($prixvB == NULL) {
            $prixvente = $prixkitB / $btekitB;
            $prixvB = round($prixvente / 5) * 5;
        }
    } else {
        $prixkitB = NULL;
    }

    $serviceB = $_SESSION['service'];
    $imageB = $_POST['imageName'];
    $designB = $_POST['design'];
    $typeB = $_POST['typeb'];
    $contenantB = $_POST['typec'];
    $emballageB = $_POST['typemb'];
    $kitB = $_POST['kit'];

    $statutB = 'ON';
    $savebyB = $_SESSION['idUser'];
    $datesaveB = date('Y-m-d H:i:s');

    $sql = "INSERT INTO boisson (serviceB, imageB, designB, prixvB, typeB, contenantB, emballageB, kitB, prixkitB, btekitB, statutB, savebyB, datesaveB) VALUES (:serviceB, :imageB, :designB, :prixvB, :typeB, :contenantB, :emballageB, :kitB, :prixkitB, :btekitB, :statutB, :savebyB, :datesaveB)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceB', $serviceB);
    $stmt->bindParam(':imageB', $imageB);
    $stmt->bindParam(':designB', $designB);
    $stmt->bindParam(':prixvB', $prixvB);
    $stmt->bindParam(':typeB', $typeB);
    $stmt->bindParam(':contenantB', $contenantB);
    $stmt->bindParam(':emballageB', $emballageB);
    $stmt->bindParam(':kitB', $kitB);
    $stmt->bindParam(':prixkitB', $prixkitB);
    $stmt->bindParam(':btekitB', $btekitB);
    $stmt->bindParam(':statutB', $statutB);
    $stmt->bindParam(':savebyB', $savebyB);
    $stmt->bindParam(':datesaveB', $datesaveB);

    try {
        $stmt->execute();
        
        $message = "La boisson a été enregistrée.";
        $url = "../pages/boissons.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/boissons.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/boissons.php");
    exit;
}