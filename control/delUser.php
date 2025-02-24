<?php

include 'dbConf.php';
include 'delSession.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idt'])) {
    $idU = $_GET['idt'];
    
    $statutU = 'DEL';

    $sql = "UPDATE users SET
            statutU = :statutU
            WHERE idU = :idU";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':statutU', $statutU);
    $stmt->bindParam(':idU', $idU);

    // Execute the SQL statement
    try {
        $stmt->execute();

        addModify('users', $idU, 'Suppression du compte', $auteurM);

        // Supression de la session de l'utlisateur
        deleteSessions($idU);

        $message = "Le compte de l'utilisateur a été supprimé avec succès.";
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