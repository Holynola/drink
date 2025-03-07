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
    <i class="fa-solid fa-handshake-simple"></i>
    <h4>Commandes | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addCmdes.php" class="btn-link">Ajouter une commande</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date de commande</div>
                <div>Montant total</div>
                <div>Montant réglé</div>
                <div>Rester à régler</div>
                <div>Effectuée par</div>
                <div></div>
            </div>
            <?php
                $conC = "serviceC = $service";
                $donC = recupDon('commande', $conC);

                foreach ($donC as $cmd) {
            ?>
            <div class="all-div atr">
                <!-- Date de commande -->
                <div>
                    <?php
                        $datemade = $cmd['datemadeC'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Montant total -->
                <div>
                    <?php
                        $mont = $cmd['mttC'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </div>

                <!-- Montant réglé -->
                <div>
                    <?php
                        $reg = $cmd['mtrC']; // Premier montant réglé
                        
                        // Autres paiements
                        $id = $cmd['idC'];
                        $conP = "idTablePay = $id AND tablePay = 'commande'";
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

                <!-- Effectué par -->
                <div>
                    <?php
                        $auteurN = $cmd['madebyC'];
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
                    <a href="infosCmde.php?id=<?= $cmd['idC']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Commandes</h5>

    <div>
        Montant total des commandes :
        <b class="red">
            <?php
                $sumMtt = sumDon('commande', 'mttC', $conC);
                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                echo $totalMtt;
            ?>
        </b>
    </div>

    <div>
        Montant total des règlements :
        <b class="red">
            <?php
                $sumMtrf = sumDon('commande', 'mtrC', $conC); // Premiers paiements
                // Autres paiements
                $conA = "servicePay = $service AND tablePay = 'commande'";
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