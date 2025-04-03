<?php

include 'dbConf.php';
include 'mttConv.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idB'])) {

	$idB = $_GET['idB'];

	$prixv = $_POST['prixv'];
	$prixvB = mttConversion($prixv);

	$kitB = $_POST['kit'];

	if ($kitB == 'yes') {
		$prixkit = $_POST['prixk'];
		$prixkitB = mttConversion($prixkit);

		$btekitB = $_POST['nbrekit'];
	} elseif ($kitB == 'no') {
		$prixkitB = null;
		$btekitB = null;
	}

	$sql = "UPDATE boisson SET
			prixvB = :prixvB,
			kitB = :kitB,
			prixkitB = :prixkitB,
			btekitB = :btekitB
			WHERE idB = :idB";

	$stmt = $bdd->prepare($sql);

	$stmt->bindParam(':prixvB', $prixvB);
	$stmt->bindParam(':kitB', $kitB);
	$stmt->bindParam(':prixkitB', $prixkitB);
	$stmt->bindParam(':btekitB', $btekitB);
	$stmt->bindParam(':idB', $idB);

	try {
        $stmt->execute();

        addModify('boisson', $idB, "Modification du prix de la boisson", $auteurM);

        $message = "Le prix de la boisson a été modifié.";
        $url = '../pages/boissons.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/boissons.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
	header("Location: ../index.php");
    exit;
}