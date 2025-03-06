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
    <i class="fa-solid fa-lock"></i>
    <h4>Consignations de boisson | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addConsigns.php" class="btn-link">Faire une consignation</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date d'enregistrement</div>
                <div>Boisson</div>
                <div>Nombre de bouteilles</div>
                <div>Statut</div>
                <div>Enregistrée par</div>
                <div></div>
            </div>
            <?php
                $conC = "serviceCs = $service";
                $donC = recupDon('consign', $conC);

                foreach ($donC as $csn) {
            ?>
            <div class="all-div atr">
                <!-- Date d'enregistrement -->
                <div>
                    <?php
                        $dateEng = $csn['datesaveCs'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Boisson -->
                <div>
                    <?php
                        $idB = $csn['boissonCs'];
                        $conB = "idB = $idB";
                        $donB = recupDon('boisson', $conB);

                        foreach ($donB as $bs) {
                            echo $bs['designB'];
                        }
                    ?>
                </div>
                
                <!-- Nombre de bouteilles -->
                <div><?= $csn['nbrebteCs'] ?></div>
                
                <!-- Statut -->
                <div>
                    <?php
                        $statut = $csn['statutCs'];

                        if ($statut == "OK") {
                            echo "Récupéré par le client";
                        } else {
                            echo "En stock";
                        }
                    ?>
                </div>
                
                <!-- Enregistrée par -->
                <div>
                    <?php
                        $saveby = $csn['savebyCs'];
                        $conUs = "idU = $saveby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
                </div>
                
                <div>
                    <a href="infosConsign.php?id=<?= $csn['idCs']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>