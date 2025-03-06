<?php
// get_prix_boisson.php
require 'dbConf.php';

if (isset($_GET['id'])) {
    $idB = $_GET['id'];

    try {
        $stmt = $bdd->prepare('SELECT prixkitB, prixvB FROM boisson WHERE idB = :idB');
        $stmt->execute(['idB' => $idB]);
        $boisson = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($boisson) {
            echo json_encode([
                'prixkitB' => $boisson['prixkitB'],
                'prixvB' => $boisson['prixvB']
            ]);
        } else {
            echo json_encode(['error' => 'Boisson non trouvée']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur de base de données']);
    }
} else {
    echo json_encode(['error' => 'ID non fourni']);
}
?>