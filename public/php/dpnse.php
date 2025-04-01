<?php

include '../control/alert.php';
include '../control/infoSess.php';

include 'triCon.php';
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
    <h4>Dépenses | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addDpnses.php" class="btn-link">Ajouter une dépense</a>
    </div>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>

<div class="content">
    <!-- Condition de tri des dépenses -->
    <?php
        if (!empty($divCon)) {
            $con = "serviceDp = $service AND datemadeDp LIKE '{$divCon}%'";
            $conA = "servicePay = $service AND tablePay = 'depense' AND datemadePay LIKE '{$divCon}%'";
        } else {
            $con = "serviceDp = $service";
            $conA = "servicePay = $service AND tablePay = 'depense'";
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>Date de dépense</th>
                <th>Montant</th>
                <th>Montant reglé</th>
                <th>Restant à régler</th>
                <th>Détails</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $donD = recupDon('depense', $con);

                foreach ($donD as $dp) {
            ?>
            <tr>
                <!-- Date de dépense -->
                <td>
                    <?php
                        $datemade = $dp['datemadeDp'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Montant -->
                <td>
                    <?php
                        $mont = $dp['mttDp'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </td>
                
                <!-- Montant réglé -->
                <td>
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
                </td>
                
                <!-- Reste à régler -->
                <td>
                    <?php
                        $reste = $mont - $montr;
                        $rar = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rar;
                    ?>
                </td>
                
                <!-- Détails -->
                <td><?= $dp['detailDp']; ?></td>

                <td>
                    <a href="infosDpense.php?idDp=<?= $dp['idDp']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
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