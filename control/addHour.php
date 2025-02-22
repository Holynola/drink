<?php

function addHeure($dateEnr) {
    $dateTime = new DateTime($dateEnr);
    $timestamp = $dateTime->getTimestamp();
    $heure = date('H:i:s', $timestamp);
    return $heure;
}
