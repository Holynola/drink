<?php

include '../control/infoSess.php';
?>
<style>

.all-div div:nth-child(5) {
    color: var(--rouge);
}

.all-div div:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-house-user"></i>
    <h4>Stock | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div">
        <span>Trier :</span>
        <select name="choix" id="choix">
            <option value=""></option>
            <option value="tous">Tous</option>
            <option value="">Lieu de service</option>
        </select>

        <select name="result" id="result">
            <option value=""></option>
        </select>
    </div>

    <div class="add-btn">
        <a href="#" class="btn-link">Trier par stock</a>
        <a href="addStock.php" class="btn-link">Ajouter un stock</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Lieu de service</div>
                <div>Boisson</div>
                <div>Entrée en stock</div>
                <div>Sortie du stock</div>
                <div>Etat du stock</div>
            </div>
            <div class="all-div atr">
                <div>Maquis</div>
                <div>Flag</div>
                <div>150 Bouteilles</div>
                <div>120 Bouteilles</div>
                <div>30 Bouteilles</div>
            </div>
        </div>
    </div>
</div>