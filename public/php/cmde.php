<?php

include '../control/alert.php';
include '../control/infoSess.php';
?>
<style>

tr th:nth-child(2),
tr td:nth-child(2) {
    color: var(--rouge);
}

tr th:nth-child(4),
tr td:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Commandes | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addCmdes.php" class="btn-link">Ajouter une commande</a>
    </div>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date de commande</th>
                <th>Montant total</th>
                <th>Montant réglé</th>
                <th>Rester à régler</th>
                <th>Effectuée par</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conC = "serviceC = $service";
                $donC = recupDon('commande', $conC);

                foreach ($donC as $cmd) {
            ?>
            <tr>
                <!-- Date de commande -->
                <td>
                    <?php
                        $datemade = $cmd['datemadeC'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Montant total -->
                <td>
                    <?php
                        $mont = $cmd['mttC'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </td>

                <!-- Montant réglé -->
                <td>
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
                </td>

                <!-- Reste à régler -->
                <td>
                    <?php
                        $reste = $mont - $montr;
                        $rar = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rar;
                    ?>
                </td>

                <!-- Effectué par -->
                <td>
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
                </td>

                <td>
                    <a href="infosCmde.php?id=<?= $cmd['idC']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
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