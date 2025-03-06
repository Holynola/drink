<?php
// get_stock_boisson.php

// Inclure la connexion à la base de données
require 'dbConf.php'; // Assurez-vous que ce fichier existe et configure $bdd (objet PDO)

if (isset($_GET['id'])) {
    $idB = $_GET['id'];

    try {
        // Préparer la requête SQL avec un paramètre nommé :idB
        $stmt = $bdd->prepare("SELECT 
                            s.BoissonSt,
                            b.designB,
                            b.contenantB,
                            SUM(s.qteSt) AS total_qteSt,
                            COALESCE(SUM(p.qtePr), 0) AS total_qteVendu
                        FROM 
                            stock s
                        LEFT JOIN 
                            produit p ON s.BoissonSt = p.boissonPr
                        LEFT JOIN 
                            boisson b ON s.BoissonSt = b.idB
                        WHERE 
                            s.BoissonSt = :idB
                        GROUP BY s.BoissonSt"); // Ajouter GROUP BY pour éviter les erreurs SQL

        // Exécuter la requête avec le paramètre :idB
        $stmt->execute(['idB' => $idB]);
        $stock = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stock) {
            // Renvoyer les données au format JSON
            echo json_encode([
                'designB' => $stock['designB'],
                'contenantB' => $stock['contenantB'],
                'qteStock' => $stock['total_qteSt'],
                'qteVendu' => $stock['total_qteVendu']
            ]);
        } else {
            // Renvoyer une erreur si la boisson n'est pas trouvée
            echo json_encode(['error' => 'Boisson non trouvée']);
        }

    } catch (PDOException $e) {
        // Renvoyer une erreur en cas d'échec de la requête SQL
        echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
    }
    
} else {
    // Renvoyer une erreur si l'ID n'est pas fourni
    echo json_encode(['error' => 'ID non fourni']);
}
?>