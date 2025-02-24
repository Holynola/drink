<?php

include 'dbConf.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idt']) AND ($_POST['username'])) {
    
    $idU = $_GET['idt'];
    $userU = $_POST['username'];

    $sql = "UPDATE users SET
            userU = :userU
            WHERE idU = :idU";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':userU', $userU);
    $stmt->bindParam(':idU', $idU);

    // Execute the SQL statement
    try {
        $stmt->execute();

        addModify('users', $idU, "Modification de l'identifiant", $auteurM);

        $message = "L'identifiant de l'utilisateur a été modifié avec succès.";
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