<?php

function affStatut($statut) {
    // Vérifier la valeur de $statut
    switch ($statut) {
        case 'ON':
            echo "Activé";
            break;
        case 'OFF':
            echo "Désactivé";
            break;
        default:
            echo "Erreur";
    }
}