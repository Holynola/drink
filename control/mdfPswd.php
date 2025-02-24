<?php

include 'dbConf.php';
include 'delSession.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idt']) AND ($_POST['password'])) {
    $idU = $_GET['idt'];

    // Hash the password before inserting
    $passU = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET
            passU = :passU
            WHERE idU = :idU";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':passU', $passU);
    $stmt->bindParam(':idU', $idU);

    // Execute the SQL statement
    try {
        $stmt->execute();

        addModify('users', $idU, 'Modification du mot de passe', $auteurM);

        // Supression de la session de l'utlisateur
        deleteSessions($idU);

        $message = "Le mot de passe de l'utilisateur a été modifié avec succès.";
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