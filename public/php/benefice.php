<?php

include '../control/infoSess.php';

?>

<style>

.all-div div:nth-child(2) {
    color: var(--rouge);
}

.all-div div:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-wallet"></i>
    <h4>Bénéfices | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date du point</div>
                <div>Montant de vente</div>
                <div>Montant d'achat</div>
                <div>Bénéfices</div>
                <div></div>
            </div>
            <div class="all-div atr">
                <div>21 Février 2025</div>
                <div>100 000 FCFA</div>
                <div>65 000 FCFA</div>
                <div>35 000 FCFA</div>
                <div>
                    <a href="#">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>