<?php

include '../control/infoSess.php';

if (isset($_GET['idB']) && ($_GET['design'])) {
    $idB = $_GET['idB'];
    $designB = $_GET['design'];
} else {
    header("Location: stocks.php");
}

include '../public/css/addIventCss.php'; 

$cont; // Type de contenant
?>

<div class="top">
    <h4>Informations sur le stock | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="vent">
        <h5>Entrées en stock</h5>
        
        <table id="stock">
            <thead>
                <tr>
                    <th style="color: var(--bleu);" colspan="5">Nom de la boisson : <?= $designB; ?></th>
                </tr>
                <tr>
                    <?php
                        $conB = "idB = $idB AND serviceB = $service";
                        $donB = recupDon('boisson', $conB);

                        foreach ($donB as $bs) {
                    ?>
                    
                    <th>Date d'ajout</th>
                    
                    <th>Commandes</th>
                    
                    <th>
                        Nombre de 
                        <?php
                            $emb = $bs['emballageB'];
                            affEm($emb);
                            echo 's';
                        ?>
                    </th>
                    
                    <th>
                        Nombre de
                        <?php
                            $cont = $bs['contenantB'];
                            affCont($cont);
                            echo 's';
                        ?>
                        par
                        <?php
                            affEm($emb);
                        ?>
                    </th>
                    
                    <th>
                        Quantité (Nombre de 
                        <?php
                            affCont($cont);
                            echo 's';
                        ?>)
                    </th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php
                    $conSt = "BoissonSt = $idB AND serviceSt = $service";
                    $donSt = recupDon('stock', $conSt);

                    foreach ($donSt as $stk) {
                ?>
                <tr>
                    <!-- Date d'ajout -->
                    <td>
                        <?php
                            $dateEnr = $stk['datesaveSt'];
                            $dateF = extraireDateFR($dateEnr);
                            echo $dateF;
                        ?>
                    </td>
                    
                    <!-- Commandes -->
                    <td>
                        <?php
                            if ($stk['cmdSt'] !== null) {
                                $cmd = $stk['cmdSt'];
                                echo 'N°' . $cmd;
                            } else {
                                echo 'Stock initial';
                            }
                        ?>
                    </td>
                    
                    <!-- Nombre de casiers -->
                    <td>
                        <?php
                            $nbrecars = $stk['nbrecarsSt'];
                            echo $nbrecars;
                        ?>
                    </td>
                    
                    <!-- Nombre de bouteilles par casier -->
                    <td>
                        <?php
                            $nbrebtle = $stk['nbrebtleSt'];
                            echo $nbrebtle;
                        ?>
                    </td>
                    
                    <!-- Quantité (Nombre de Bouteilles) -->
                    <td style="position: relative;">
                        <?php
                            echo $stk['qteSt'];

                            // Affichage du bouton Supprimer pour les stock initiaux
                            if ($stk['cmdSt'] == null) {
                                ?>
                                    <div class="supp">
                                        <a href="../control/delInit.php?idSt=<?=$stk['idSt'];?>&idB=<?=$idB;?>&qte=<?= $stk['qteSt']; ?>" title="Supprimer" onclick="return confirmLink()">X</a>
                                    </div>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <h5>Sorties du stock</h5>

        <table id="vente">
            <thead>
                <tr>
                    <th style="color: var(--bleu);" colspan="3">Nom de la boisson : <?= $designB; ?></th>
                </tr>
                <tr>
                    <th>Date de vente</th>
                    
                    <th>
                        Quantité (Nombre de
                        <?php
                            affCont($cont);
                            echo 's';
                        ?>)
                    </th>
                    
                    <th>Montant de vente</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $conPr = "boissonPr = $idB AND servicePr = $service";
                    $donPr = recupDon('produit', $conPr);

                    foreach ($donPr as $pr) {
                ?>
                <tr>
                    <!-- Date de vente -->
                    <td>
                        <?php
                            $vent = $pr['ventPr'];
                            $conV = "idV = $vent AND serviceV = $service";
                            $donV = recupDon('inventory', $conV);
                            foreach ($donV as $vvv) {
                                $dateMade = $vvv['datemadeV'];
                                $dateFR = extraireDateFR($dateMade);
                                echo $dateFR;
                            }
                        ?>
                    </td>
                    
                    <!-- Nombre de bouteilles vendus -->
                    <td><?= $pr['qtePr']; ?></td>
                    
                    <!-- Montant de vente -->
                    <td>
                        <?php
                            $mont = $pr['mttPr'];
                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                            echo $mtt;
                        ?>
                    </td>

                </tr>
                <?php } ?>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

<script src="../public/js/calculStock.js"></script>
<script src="../public/js/calculProd.js"></script>
<script src="../public/js/conf.js"></script>