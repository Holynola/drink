<?php 

include '../control/infoSess.php';
include '../control/recupStk.php';

include '../public/css/addUserCss.php';
include '../public/css/addIventCss.php'; 
?>

<div class="top">
    <h4>Faire un inventaire | <?= $lieu; ?></h4>
</div>

<p style="text-align: center;">NB : Vérifier si les Consignations n'ont pas été récupérées avant de faire l'inventaire</p>

<div class="content">
    <div class="vent">
        <table id="tableVentes">
            <thead>
                <tr>
                    <th>Boisson</th>
                    <th>Stock initial</th>
                    <th>Stock après vente</th>
                    <th>Consignation</th>
                    <th>Produits vendus</th>
                    <th>Montants</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conS = "SELECT 
                                s.BoissonSt,
                                s.serviceSt,
                                b.idB,
                                b.designB,
                                b.prixvB,
                                b.prixkitB,
                                b.btekitB,
                                SUM(s.qteSt) AS total_qteSt
                            FROM 
                                stock s
                            LEFT JOIN 
                                boisson b ON s.BoissonSt = b.idB
                            WHERE 
                                s.serviceSt = $service
                            GROUP BY 
                                s.BoissonSt, s.serviceSt, b.idB, b.designB, b.prixvB, b.prixkitB, b.btekitB;";
                    
                    $donS = recupStock($conS);

                    foreach ($donS as $stk) {
                        $boissonId = $stk['BoissonSt'];
                        $conP = "servicePr = $service AND boissonPr = $boissonId";
                        $vendu = sumDon('produit', 'qtePr', $conP);

                        $initial = $stk['total_qteSt'] - $vendu;

                        if ($initial > 0) {
                ?>
                <tr>
                    <!-- Boisson -->
                    <td class="<?= $stk['idB']; ?>"><?= $stk['designB']; ?></td>
                    
                    <!-- Stock initial -->
                    <td><?= $initial; ?></td>
                    
                    <!-- Stock après vente -->
                    <td>
                        <input type="number" name="stock[]" required>
                    </td>
                    
                    <?php
                        $id = $stk['idB'];
                        $conC = "boissonCs = $id AND serviceCs = $service AND statutCs = 'KO'";
                        $donC = sumDon('consign', 'nbrebteCs', $conC);
                    ?>
                    <!-- Consignations -->
                    <td>
                        <?php if ($donC) {echo $donC;} else {echo 0;} ?>
                    </td>
                    
                    <!-- Produits vendus -->
                    <td class="produits-vendus"></td>
                    
                    <!-- Montant -->
                    <td class="montant"></td>

                    <!-- Stocker les prix et btekitB dans des attributs data -->
                    <td class="prix" 
                        data-prixvb="<?= $stk['prixvB']; ?>" 
                        data-prixkitb="<?= $stk['prixkitB']; ?>" 
                        data-btekitb="<?= $stk['btekitB']; ?>" 
                        style="display: none;">
                    </td>
                </tr>
                <?php   
                        }
                    } 
                ?>
                <tr>
                    <td style="background-color: var(--rouge);color: var(--blanc);">Totaux</td>
                    
                    <!-- Total Stock initial -->
                    <td></td>
                    
                    <!-- Total Stock après vente -->
                    <td></td>
                    
                    <!-- Total Consignation -->
                    <td></td>
                    
                    <!-- Total Produits vendus -->
                    <td></td>
                    
                    <!-- Total Montants -->
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if ($donS) { ?>
    <div class="user">
        <div class="r-info">
            <form action="../control/addVent.php" id="venteForm" method="post">
                <input type="hidden" id="lignes" name="lignes" value="">

                <div>
                    <label for="mtt">Montant recette</label><br>
                    <input type="text" name="mtt" id="mtt" readonly required>
                </div>

                <div>
                    <label for="mtr">Montant reçu</label><br>
                    <input type="text" name="mtr" id="mtr" class="currency" autocomplete="off" required>
                </div>

                <div>
                    <label for="diff">Différence</label><br>
                    <input type="text" name="diff" id="diff" readonly required>
                </div>

                <div>
                    <label for="det">Observation</label><br>
                    <textarea name="det" id="det"></textarea>
                </div>

                <div>
                    <label for="getby">Caissier/ière</label><br>
                    <select name="getby" id="getby">
                        <option value=""></option>
                        <?php
                            $conU = "posteU = 4 AND serviceU = $service";
                            $donU = recupDon('users', $conU);

                            foreach ($donU as $us) {
                        ?>
                        <option value="<?= $us['idU']; ?>"><?= $us['nomU'] . ' ' . $us['prenomsU']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="madeby">Effectué par</label><br>
                    <select name="madeby" id="madeby" required>
                        <option value=""></option>
                        <?php
                            $conUs = "(posteU = 3 OR posteU = 4) AND serviceU = $service";
                            $donUs = recupDon('users', $conUs);

                            foreach ($donUs as $use) {
                        ?>
                        <option value="<?= $use['idU']; ?>"><?= $use['nomU'] . ' ' . $use['prenomsU']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="datemade">Date d'inventaire</label>
                    <input type="date" name="datemade" id="datemade" required>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
</div>

<script src="../public/js/calculVente.js"></script>
<script src="../public/js/calculDiff.js"></script>