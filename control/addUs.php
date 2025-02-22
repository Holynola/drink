<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbConf.php';

if (isset($_POST['pass']) && ($_POST['confpass'])) {

    if (isset($_POST['username'])) {
        $identifiant = $_POST['username'];

        $stt = $bdd->prepare("SELECT * FROM users WHERE userU = :identifiant");
    
        $stt->bindParam(':identifiant', $identifiant);
        $stt->execute();
        
        $count = $stt->rowCount();
        if ($count > 0) {
            $messag = "Identifiant déjà utilisé. Choisissez-en un autre.";
            $abc = "../pages/addUsers.php?msg=" . urldecode($messag);
            header("Location: " . $abc);
            exit;
        
        } else {
            // Information de l'utilisateur
            $serviceU = $_SESSION['service'];
            $titleU = $_POST['titre'];
            $nomU = $_POST['nom'];
            $prenomsU = $_POST['prenoms'];
            $contactU = $_POST['contact'];
            $posteU = $_POST['poste'];
            $userU = $_POST['username'];
            
            // Hash the password before inserting
            $passU = password_hash($_POST['pass'], PASSWORD_BCRYPT);

            $statutU = 'OFF';
            $savebyU = $_SESSION['idUser'];
            $date = date('Y-m-d H:i:s');

            $stmt = $bdd->prepare("INSERT INTO users(serviceU, titleU, nomU, prenomsU, posteU, contactU, userU, passU, statutU, savebyU, datesaveU) VALUES (:serviceU, :titleU, :nomU, :prenomsU, :posteU, :contactU, :userU, :passU, :statutU, :savebyU, :datesaveU)");

            $stmt->bindParam(':serviceU', $serviceU);
            $stmt->bindParam(':titleU', $titleU);
            $stmt->bindParam(':nomU', $nomU);
            $stmt->bindParam(':prenomsU', $prenomsU);
            $stmt->bindParam(':posteU', $posteU);
            $stmt->bindParam(':contactU', $contactU);
            $stmt->bindParam(':userU', $userU);
            $stmt->bindParam(':passU', $passU);
            $stmt->bindParam(':statutU', $statutU);
            $stmt->bindParam(':savebyU', $savebyU);
            $stmt->bindParam(':datesaveU', $date);

            try {
                $stmt->execute();
                $message = "L'utilisateur a bien été enregistré. Veuillez activer son compte.";
                $url = "../pages/users.php?msg=" . urldecode($message);
                header("Location: " . $url);
                exit;
            } catch (PDOException $e) {
                $mess = "Erreur ! Veuillez réessayer plus tard";
                $urls = '../pages/users.php?msg=' . urldecode($mess);
                die("Error executing SQL query: " . $e->getMessage());
            }
        }

    } else {
        header("Location: ../pages/users.php");
        exit;
    }

} else {
    header("Location: ../index.php");
    exit;
}