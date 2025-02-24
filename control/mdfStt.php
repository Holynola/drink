<?php

include 'dbConf.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idt']) && ($_GET['statut'])) {

    $idU = $_GET['idt'];

    $statut = $_GET['statut'];
    if ($statut == 'ON') {
        $statutU = 'OFF';
    } elseif ($statut == 'OFF') {
        $statutU = 'ON';
    } else {
        header("Location: ../pages/users.php");
        exit;
    }

    $sql = "UPDATE users SET
            statutU = :statutU
            WHERE idU = :idU";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':statutU', $statutU);
    $stmt->bindParam(':idU', $idU);

    // Execute the SQL statement
    try {
        $stmt->execute();

        if ($statutU == 'OFF') {
            $actionM = 'Désactivation du compte';
        } elseif ($statutU == 'ON') {
            $actionM = 'Activation du compte';
        }

        addModify('users', $idU, $actionM, $auteurM);

        $message = "Le statut de l'utilisateur a été modifié avec succès.";
        $url = '../pages/users.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/users.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    exit;
}