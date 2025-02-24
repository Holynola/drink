<?php

include '../control/alert.php';
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
    <i class="fa-solid fa-truck"></i>
    <h4>Fournisseurs | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div"></div>

    <div class="add-btn">
        <a href="addFours.php" class="btn-link">Ajouter un fournisseur</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date d'enregistrement</div>
                <div>Nom du fournisseur</div>
                <div>Localisation</div>
                <div>Contact</div>
                <div></div>
            </div>
            <?php
                $conF = "statutF = 'ON' ORDER BY nomF ASC";
                $donF = recupDon('fournisseur', $conF);

                foreach ($donF as $four) {
            ?>
            <div class="all-div atr">
                <!-- Date d'enregistrement -->
                <div>
                    <?php
                        $dateEng = $four['datesaveF'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Nom du fournisseur -->
                <div><?= $four['nomF']; ?></div>
                
                <!-- Localisation -->
                <div><?= $four['localF']; ?></div>
                
                <!-- Contact -->
                <div><?= $four['numF']; ?></div>
                
                <div>
                    <a href="../control/delFour.php?idt=<?= $four['idF']; ?>" onclick="return confirmLink()">Supprimer</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="../public/js/conf.js"></script>