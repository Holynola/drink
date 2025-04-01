<?php

function extraireMoisFR($datesave) {
    $date = new DateTime($datesave);
    $mois = $date->format('m');
    $annee = $date->format('Y');

    // Traduction du mois en français
    switch ($mois) {
        case 1:
            $moisFR = "Janvier";
            break;
        case 2:
            $moisFR = "Février";
            break;
        case 3:
            $moisFR = "Mars";
            break;
        case 4:
            $moisFR = "Avril";
            break;
        case 5:
            $moisFR = "Mai";
            break;
        case 6:
            $moisFR = "Juin";
            break;
        case 7:
            $moisFR = "Juillet";
            break;
        case 8:
            $moisFR = "Août";
            break;
        case 9:
            $moisFR = "Septembre";
            break;
        case 10:
            $moisFR = "Octobre";
            break;
        case 11:
            $moisFR = "Novembre";
            break;
        case 12:
            $moisFR = "Décembre";
            break;
    }

    return $moisFR . " " . $annee;
}
