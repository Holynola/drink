<?php

function extraireDateFR($datesave) {
    $date = new DateTime($datesave);
    $jour = $date->format('j');
    $mois = $date->format('m');
    $annee = $date->format('Y');

    // Traduction du mois en français
    switch ($mois) {
        case 1:
            $moisFR = "janvier";
            break;
        case 2:
            $moisFR = "février";
            break;
        case 3:
            $moisFR = "mars";
            break;
        case 4:
            $moisFR = "avril";
            break;
        case 5:
            $moisFR = "mai";
            break;
        case 6:
            $moisFR = "juin";
            break;
        case 7:
            $moisFR = "juillet";
            break;
        case 8:
            $moisFR = "août";
            break;
        case 9:
            $moisFR = "septembre";
            break;
        case 10:
            $moisFR = "octobre";
            break;
        case 11:
            $moisFR = "novembre";
            break;
        case 12:
            $moisFR = "décembre";
            break;
    }

    return $jour. " ". $moisFR. " ". $annee;
}