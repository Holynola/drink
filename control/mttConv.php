<?php

function mttConversion($montant) {
    $mtt = preg_replace('/[^0-9]/', '', $montant);
    return $mtt;
}