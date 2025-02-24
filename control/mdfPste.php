<?php

include 'dbConf.php';
include 'addMdfy.php';

$auteurM = $_SESSION['idUser'];

if (isset($_GET['idt']) && ($_POST['poste'])) {
    
    $idU = $_GET['idt'];
    $posteU = $_POST['poste'];

    if (($posteU != 3) && ($posteU != 4)) {
        $serviceU = 3;
    
    } else {
        $serviceU = $_POST['service'];
    }

    $sql = "UPDATE users SET
            serviceU = :serviceU,
            posteU = :posteU
            WHERE idU = :idU";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceU', $serviceU);
    $stmt->bindParam(':posteU', $posteU);
    $stmt->bindParam(':idU', $idU);

    // Execute the SQL statement
    try {
        $stmt->execute();

        addModify('users', $idU, 'Modification du poste', $auteurM);

        $message = "Le poste de l'utilisateur a été modifié avec succès.";
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