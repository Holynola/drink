<?php

include '../control/infoSess.php';
?>
<style>

.all-div div:nth-child(2) {
    color: var(--rouge);
}

.all-div div:nth-child(3) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-chart-simple"></i>
    <h4>Points | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addPoints.php" class="btn-link">Faire un point</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date du point</div>
                <div>Montant total</div>
                <div>Montant versé</div>
                <div>Gérant</div>
                <div>Gestionnaire</div>
                <div></div>
            </div>
            <div class="all-div atr">
                <div>20 Février 2025</div>
                <div>200 000 FCFA</div>
                <div>195 000 FCFA</div>
                <div>Charles Yao</div>
                <div>Koné Moussa</div>
                <div>
                    <a href="#">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>