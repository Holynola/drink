<?php

// Déclaration globale des variables session
$service = $_SESSION["service"];
global $service;

$idUser = $_SESSION["idUser"];
global $idUser;

$titre = $_SESSION["titre"];
global $titre;

$nom = $_SESSION["nom"];
global $nom;

$prenoms = $_SESSION["prenoms"];
global $prenoms;

$poste = $_SESSION["poste"];
global $poste;

$contact = $_SESSION["contact"];
global $contact;

// Récupération du lieu de service
$conWk = "idW = $service";
$donWk = recupDon('work', $conWk);
$lieu;

foreach ($donWk as $wk) {
    $work = $wk['libelleW'];
}

$lieu = $work;
global $lieu;