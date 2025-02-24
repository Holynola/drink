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
    <i class="fa-solid fa-coins"></i>
    <h4>Dépenses | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addDpnses.php" class="btn-link">Ajouter une dépense</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date de dépense</div>
                <div>Montant</div>
                <div>Montant reglé</div>
                <div>Restant à régler</div>
                <div>Détails</div>
                <div></div>
            </div>
            <?php
                $con = "serviceDp = $service";
                $donD = recupDon('depense', $con);

                foreach ($donD as $dp) {
            ?>
            <div class="all-div atr">
                <!-- Date de dépense -->
                <div>
                    <?php
                        $datemade = $dp['datemadeDp'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Montant -->
                <div>
                    <?php
                        $mont = $dp['mttDp'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </div>
                
                <!-- Montant réglé -->
                <div>
                    <?php
                        $reg = $dp['mtrDp']; // Premier montant réglé
                        
                        // Autres paiements
                        $id = $dp['idDp'];
                        $conP = "idTablePay = $id AND tablePay = 'depense'";
                        $pay = sumDon('paiement', 'mttPay', $conP);
                        
                        $montr = $reg + $pay;
                        $mtr = number_format($montr, 0, ' ', ' ') . ' FCFA';
                        echo $mtr;
                    ?>
                </div>
                
                <!-- Reste à régler -->
                <div>
                    <?php
                        $reste = $mont - $montr;
                        $rar = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rar;
                    ?>
                </div>
                
                <!-- Détails -->
                <div><?= $dp['detailDp']; ?></div>

                <div>
                    <a href="infosDpense.php?idDp=<?= $dp['idDp']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Dépenses</h5>

    <div>
        Montant total des dépenses :
        <b class="red">
            <?php
                $sumMtt = sumDon('depense', 'mttDp', $con);
                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                echo $totalMtt;
            ?>
        </b>
    </div>

    <div>
        Montant total des règlements :
        <b class="red">
            <?php
                $sumMtrf = sumDon('depense', 'mtrDp', $con); // Premiers paiements
                // Autres paiements
                $conA = "servicePay = $service AND tablePay = 'depense'";
                $sumMtra = sumDon('paiement', 'mttPay', $conA); 

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