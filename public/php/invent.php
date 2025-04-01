<?php

include '../control/alert.php';
include '../control/infoSess.php';

include 'triCon.php';
?>

<style>

tr th:nth-child(3),
tr td:nth-child(3) {
    color: var(--rouge);
}

tr th:nth-child(4),
tr td:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Inventaires | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addIvents.php" class="btn-link">Faire un inventaire</a>
    </div>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>

<div class="content">
    <!-- Condition de tri des inventaires -->
    <?php
        if (!empty($divCon)) {
            $conI = "serviceV = $service AND datemadeV LIKE '{$divCon}%'";
            $conA = "serviceR = $service AND datemadeR LIKE '{$divCon}%'";
        } else {
            $conI = "serviceV = $service";
            $conA = "serviceR = $service";
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>Date d'inventaire</th>
                <th>Montant recette</th>
                <th>Montant reçu</th>
                <th>Différence</th>
                <th>Effectué par</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $donI = recupDon('inventory', $conI);

                foreach ($donI as $iv) {
            ?>
            <tr>
                <!-- Date d'inventaire -->
                <td>
                    <?php
                        $datemade = $iv['datemadeV'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Montant recette -->
                <td>
                    <?php
                        $mont = $iv['mttV'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </td>
                
                <!-- Montant reçu -->
                <td>
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
                </td>
                
                <!-- Différence -->
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
                        $auteurN = $iv['madebyV'];
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
                    <a href="infosVent.php?id=<?= $iv['idV']; ?>">Plus de détails</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
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
                $sumMtra = sumDon('reglement', 'mttR', $conA);

                $sumMtr = $sumMtrf + $sumMtra;
                $totalMtr = number_format($sumMtr, 0, ' ', ' ') . ' FCFA';
                echo $totalMtr;
            ?>
        </b>
    </div>

    <div>
        Différence totale :
        <b class="blue">
            <?php
                $sumRes = $sumMtt - $sumMtr;
                $totalRes = number_format($sumRes, 0, ' ', ' ') . ' FCFA';
                echo $totalRes;
            ?>
        </b>
    </div>
</div>