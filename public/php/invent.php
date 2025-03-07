<?php

include '../control/alert.php';
include '../control/infoSess.php';
?>

<style>

.all-div div:nth-child(3) {
    color: var(--rouge);
}

.all-div div:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-sack-dollar"></i>
    <h4>Inventaires | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addIvents.php" class="btn-link">Faire un inventaire</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date d'inventaire</div>
                <div>Montant recette</div>
                <div>Montant reçu</div>
                <div>Différence</div>
                <div>Effectué par</div>
                <div></div>
            </div>
            <?php
                $conI = "serviceV = $service";
                $donI = recupDon('inventory', $conI);

                foreach ($donI as $iv) {
            ?>
            <div class="all-div atr">
                <!-- Date d'inventaire -->
                <div>
                    <?php
                        $datemade = $iv['datemadeV'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Montant recette -->
                <div>
                    <?php
                        $mont = $iv['mttV'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </div>
                
                <!-- Montant reçu -->
                <div>
                    <?php
                        $reg = $iv['mtrV']; // Montant reçu

                        // Autres réglements
                        $id = $iv['idV'];
                        $conR = "ventR = $id AND serviceR = $service";
                        $pay = sumDon('reglement', 'mttR', $conR);

                        $montr = $reg + $pay;
                        $mtr = number_format($montr, 0, ' ', ' ') . ' FCFA';
                        echo $mtr;
                    ?>
                </div>
                
                <!-- Différence -->
                <div>
                    <?php
                        $reste = $mont - $montr;
                        $rar = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rar;
                    ?>
                </div>
                
                <!-- Effectué par -->
                <div>
                    <?php
                        $auteurN = $iv['madebyV'];
                        $cond = "idU = $auteurN";
                        $donU = recupDon('users', $cond);

                        if ($donU) {
                            foreach ($donU as $auteur) {
                                echo $auteur['nomU'] . ' ' . $auteur['prenomsU'];
                            }
                        }
                    ?>
                </div>
                
                <div>
                    <a href="infosVent.php?id=<?= $iv['idV']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Inventaires</h5>

    <div>
        Montant total des recettes :
        <b class="red">
            <?php
                $sumMtt = sumDon('inventory', 'mttV', $conI);
                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                echo $totalMtt;
            ?>
        </b>
    </div>

    <div>
        Montant total reçu :
        <b class="red">
            <?php
                $sumMtrf = sumDon('inventory', 'mtrV', $conI); // Montants reçus

                // Autres règlements
                $conA = "serviceR = $service";
                $sumMtra = sumDon('reglement', 'mttR', $conA);

                $sumMtr = $sumMtrf + $sumMtra;
                $totalMtr = number_format($sumMtr, 0, ' ', ' ') . ' FCFA';
                echo $totalMtr;
            ?>
        </b>
    </div>

    <div>
        Reste total à régler :
        <b class="blue">
            <?php
                $sumRes = $sumMtt - $sumMtr;
                $totalRes = number_format($sumRes, 0, ' ', ' ') . ' FCFA';
                echo $totalRes;
            ?>
        </b>
    </div>
</div>