<?php

include '../control/infoSess.php';
include '../control/recupStk.php';

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
    <i class="fa-solid fa-wallet"></i>
    <h4>Bénéfices | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date d'enregistrement</div>
                <div>Montant de vente</div>
                <div>Montant d'achat</div>
                <div>Bénéfices</div>
                <div></div>
            </div>
            <?php
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
                $donB = recupStock($conB);

                foreach ($donB as $benef) {
            ?>
            <div class="all-div atr">
                <!-- Date d'enregistrement -->
                <div>
                    <?php
                        $dateEng = $benef['datesaveBf'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Montant de vente -->
                <div>
                    <?php
                        $mont = $benef['total_mtv'];
                        $mtv = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtv;
                    ?>
                </div>
                
                <!-- Montant d'achat -->
                <div>
                    <?php
                        $monta = $benef['total_mta'];
                        $mta = number_format($monta, 0, ' ', ' ') . ' FCFA';
                        echo $mta;
                    ?>
                </div>
                
                <!-- Bénéfice -->
                <div>
                    <?php
                        $bnf = $benef['total_benef'];
                        $benefice = number_format($bnf, 0, ' ', ' ') . ' FCFA';
                        echo $benefice;
                    ?>
                </div>
                
                <div>
                    <a href="infosBenef.php?id=<?= $benef['ventBf']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Bénéfices</h5>

    <div>
        Montant total des ventes :
        <b class="red">
            <?php
                $conBf = "serviceBf = $service";
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