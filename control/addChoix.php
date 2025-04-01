<?php

include 'dbConf.php';

if (isset($_POST["choix"])) {
    $choix = $_POST['choix'];

    if ($choix == "mois") {
        
        // Tableau contenant les noms des mois en français
        $mois = [
            "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ];

        // Récupérer le mois et l'année en cours au format m-Y
        $moisCourant = date("Y-m");

        // Séparer le mois et l'année
        list($anneeCourante, $moisNum) = explode('-', $moisCourant);
        $moisNum = (int)$moisNum;

        // Générer les options du select pour les 12 mois précédents
        $options = "<option value=''></option>"; // Option vide

        for ($i = 0; $i < 12; $i++) {
            // Calculer l'index du mois et l'année correspondante
            $moisIndex = ($moisNum - $i - 1 + 12) % 12;
            $anneeAffichee = $anneeCourante - (($moisNum - $i - 1) < 0 ? 1 : 0);
            $nomMois = $mois[$moisIndex];
            $moisValeur = str_pad($moisIndex + 1, 2, "0", STR_PAD_LEFT);
            $options .= "<option value='$anneeAffichee-$moisValeur'>$nomMois $anneeAffichee</option>";
        }

        // Afficher le select
        echo "<select>$options</select>";
    
    } elseif ($choix == "an") {

        // Récupérer l'année en cours
        $anneeCourante = date("Y");

        // Générer les options du select pour les 3 dernières années
        $options = "<option value=''></option>"; // Option vide

        for ($a = 0; $a < 3; $a++) {
            $anneeAffichee = $anneeCourante - $a;
            $options .= "<option value='$anneeAffichee'>$anneeAffichee</option>";
        }

        // Afficher le select
        echo "<select>$options</select>";
    }
}