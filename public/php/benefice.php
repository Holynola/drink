<?php

include '../control/infoSess.php';
include '../control/recupStk.php';

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
    <h4>Bénéfices | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>

<div class="content">
    <!-- Condition de tri des bénéfices -->
    <?php
        if (!empty($divCon)) {
            $conB = "SELECT 
                        serviceBf, 
                        ventBf, 
                        datesaveBf, 
                        SUM(mtvBf) AS total_mtv, 
                        SUM(mtaBf) AS total_mta, 
                        SUM(mtvBf - mtaBf) AS total_benef
                    FROM 
                        benefice
                    WHERE
                        serviceBf = $service AND datesaveBf LIKE '{$divCon}%'
                    GROUP BY 
                        ventBf, serviceBf";

            $conBf = "serviceBf = $service AND datesaveBf LIKE '{$divCon}%'";
        } else {
            $conB = "SELECT 
                        serviceBf, 
                        ventBf, 
                        datesaveBf, 
                        SUM(mtvBf) AS total_mtv, 
                        SUM(mtaBf) AS total_mta, 
                        SUM(mtvBf - mtaBf) AS total_benef
                    FROM 
                        benefice
                    WHERE
                        serviceBf = $service
                    GROUP BY 
                        ventBf, serviceBf";

            $conBf = "serviceBf = $service";
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>Date d'enregistrement</th>
                <th>Montant de vente</th>
                <th>Montant d'achat</th>
                <th>Bénéfices</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $donB = recupStock($conB);

                foreach ($donB as $benef) {
            ?>
            <tr>
                <!-- Date d'enregistrement -->
                <td>
                    <?php
                        $dateEng = $benef['datesaveBf'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Montant de vente -->
                <td>
                    <?php
                        $mont = $benef['total_mtv'];
                        $mtv = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtv;
                    ?>
                </td>
                
                <!-- Montant d'achat -->
                <td>
                    <?php
                        $monta = $benef['total_mta'];
                        $mta = number_format($monta, 0, ' ', ' ') . ' FCFA';
                        echo $mta;
                    ?>
                </td>
                
                <!-- Bénéfice -->
                <td>
                    <?php
                        $bnf = $benef['total_benef'];
                        $benefice = number_format($bnf, 0, ' ', ' ') . ' FCFA';
                        echo $benefice;
                    ?>
                </td>
                
                <td>
                    <a href="infosBenef.php?id=<?= $benef['ventBf']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Bénéfices</h5>

    <div>
        Montant total des ventes :
        <b class="red">
            <?php
                $sumMtv = sumDon('benefice', 'mtvBf', $conBf);
                $totalMtv = number_format($sumMtv, 0, ' ', ' ') . ' FCFA';
                echo $totalMtv;
            ?>
        </b>
    </div>

    <div>
        Montant total des achats :
        <b class="red">
            <?php
                $sumMta = sumDon('benefice', 'mtaBf', $conBf);
                $totalMta = number_format($sumMta, 0, ' ', ' ') . ' FCFA';
                echo $totalMta;
            ?>
        </b>
    </div>

    <div>
        Bénéfice total :
        <b class="blue">
            <?php
                $sumBef = $sumMtv - $sumMta;
                $totalBef = number_format($sumBef, 0, ' ', ' ') . ' FCFA';
                echo $totalBef;
            ?>
        </b>
    </div>
</div>