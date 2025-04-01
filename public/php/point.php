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

tr th:nth-child(3),
tr td:nth-child(3) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Points | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addPoints.php" class="btn-link">Faire un point</a>
    </div>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>

<div class="content">
    <!-- Condition de tri de la table Point -->
    <?php
        if (!empty($divCon)) {
            $conP = "serviceP = $service AND datemadeP LIKE '{$divCon}%'";
        } else {
            $conP = "serviceP = $service";
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>Date du point</th>
                <th>Montant total</th>
                <th>Montant versé</th>
                <th>Manquant</th>
                <th>Gérant(e)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $donP = recupDon('points', $conP);

                foreach ($donP as $pt) {
            ?>
            <tr>
                <!-- Date du point -->
                <td>
                    <?php
                        $datemade = $pt['datemadeP'];
                        $dateFR = extraireDateFR($datemade);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Montant total -->
                <td>
                    <?php
                        $mont = $pt['mttP'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </td>
                
                <!-- Montant versé -->
                <td>
                    <?php
                        $montv = $pt['mtvP'];
                        $mtv = number_format($montv, 0, ' ', ' ') . ' FCFA';
                        echo $mtv;
                    ?>
                </td>
                
                <!-- Manquant -->
                <td>
                    <?php
                        $mk = $pt['mankP'];
                        $mank = number_format($mk, 0, ' ', ' ') . ' FCFA';
                        echo $mank;
                    ?>
                </td>
                
                <!-- Gérant -->
                <td>
                    <?php
                        $auteurN = $pt['getbyP'];
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
                    <a href="infosPoint.php?id=<?=$pt['idP'];?>">Plus de détails</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Points</h5>

    <div>
        Montant total :
        <b class="red">
            <?php
                $sumMtt = sumDon('points', 'mttP', $conP);
                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                echo $totalMtt;
            ?>
        </b>
    </div>

    <div>
        Montant versé :
        <b class="red">
            <?php
                $sumMtv = sumDon('points', 'mtvP', $conP);
                $totalMtv = number_format($sumMtv, 0, ' ', ' ') . ' FCFA';
                echo $totalMtv;
            ?>
        </b>
    </div>

    <div>
        Manquant total :
        <b class="blue">
            <?php
                $sumMk = sumDon('points', 'mankP', $conP);
                $totalMk = number_format($sumMk, 0, ' ', ' ') . ' FCFA';
                echo $totalMk;
            ?>
        </b>
    </div>
</div>