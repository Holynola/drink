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
    <i class="fa-solid fa-sack-dollar"></i>
    <h4>Ventes | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addVentes.php" class="btn-link">Ajouter une vente</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date de vente</div>
                <div>Montant de vente</div>
                <div>Montant réglé</div>
                <div>Reste à régler</div>
                <div>Caissier/ière</div>
                <div></div>
            </div>
            <div class="all-div atr">
                <div>19 Février 2025</div>
                <div>100 000 FCFA</div>
                <div>95 000 FCFA</div>
                <div>5 000 FCFA</div>
                <div>Julitte Koffi</div>
                <div>
                    <a href="#">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>