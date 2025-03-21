<?php

include '../control/infoSess.php';
include '../control/recupStk.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: cmdes.php");
}

include '../public/css/addIventCss.php'; 

?>

<div class="top">
    <h4>Informations sur le bénéfice | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="vent">
        <h5> Date d'inventaire : 
        <?php
            $conV = "idV = $id AND serviceV = $service";
            $donV = recupDon('inventory', $conV);

            foreach ($donV as $vvv) {
                $dateM = $vvv['datemadeV'];
                $dateFR = extraireDateFR($dateM);
                echo $dateFR;
            }
        ?>
        </h5>

        <table id="benef">
            <thead>
                <tr>
                    <th>Boisson</th>
                    <th>Quantité (Nombre de bouteilles)</th>
                    <th>Montant de vente</th>
                    <th>Montant d'achat</th>
                    <th>Bénéfice</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conB = "SELECT
                                serviceBf,
                                boissonBf,
                                SUM(qteBf) AS total_qte,
                                SUM(mtvBf) AS total_mtv, 
                                SUM(mtaBf) AS total_mta 
                            FROM
                                benefice
                            WHERE
                                ventBf = $id AND serviceBf = $service
                            GROUP BY
                                boissonBf, serviceBf";
                    $donB = recupStock($conB);

                    foreach ($donB as $bnf) {
                ?>
                <tr>
                    <!-- Boisson -->
                    <td>
                        <?php
                            $idB = $bnf['boissonBf'];
                            $conS = "idB = $idB";
                            $donS = recupDon('boisson', $conS);
                            foreach ($donS as $bs) {
                                echo $bs['designB'];
                            }
                        ?>
                    </td>
                    
                    <!-- Quantité -->
                    <td><?= $bnf['total_qte']; ?></td>
                    
                    <!-- Montant de vente -->
                    <td>
                        <?php
                            $mont = $bnf['total_mtv'];
                            $mtv = number_format($mont, 0, ' ', ' ') . ' FCFA';
                            echo $mtv;
                        ?>
                    </td>
                    
                    <!-- Montant d'achat -->
                    <td>
                        <?php
                            $monta = $bnf['total_mta'];
                            $mta = number_format($monta, 0, ' ', ' ') . ' FCFA';
                            echo $mta;
                        ?>
                    </td>
                    
                    <!-- Bénéfice -->
                    <td>
                        <?php
                            $bnf = $mont - $monta;
                            $benefice = number_format($bnf, 0, ' ', ' ') . ' FCFA';
                            echo $benefice;
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

<script src="../public/js/calculBenef.js"></script>