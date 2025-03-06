<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbConf.php';

if (isset($_POST['boisson']) && ($_POST['nbrebte'])) {

    $serviceCs = $_SESSION['service'];
    $boissonCs = $_POST['boisson'];
    $nbrebteCs = $_POST['nbrebte'];

    if (isset($_POST['det']) && ($_POST['det'] !== "")) {
        $detailCs = $_POST['det'];
    } else {
        $detailCs = null;
    }

    $savebyCs = $_SESSION['idUser'];
    $datesaveCs = date('Y-m-d H:i:s');
    $statutCs = 'KO';

    $sql = "INSERT INTO consign (serviceCs, boissonCs, nbrebteCs, detailCs, savebyCs, datesaveCs, statutCs, madebyCs, datemadeCs) VALUES (:serviceCs, :boissonCs, :nbrebteCs, :detailCs, :savebyCs, :datesaveCs, :statutCs, NULL, NULL)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceCs', $serviceCs);
    $stmt->bindParam(':boissonCs', $boissonCs);
    $stmt->bindParam(':nbrebteCs', $nbrebteCs);
    $stmt->bindParam(':detailCs', $detailCs);
    $stmt->bindParam(':savebyCs', $savebyCs);
    $stmt->bindParam(':datesaveCs', $datesaveCs);
    $stmt->bindParam(':statutCs', $statutCs);

    try {
        $stmt->execute();
        
        $message = "Votre consignation a bien été enregistrée.";
        $url = "../pages/consigns.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/consigns.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/consigns.php");
    exit;
}