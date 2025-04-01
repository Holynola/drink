<?php 

include '../control/infoSess.php';
include '../control/recupStk.php';

include '../public/css/bordCss.php';

include 'triCon.php';
?>

<div class="top">
    <h4>Tableau de bord | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>

<div class="content">
    <!-- Condition de tri de chaque table -->
    <?php
        if (!empty($divCon)) {
            $conP = "serviceP = $service AND datemadeP LIKE '{$divCon}%'";
            $conBf = "serviceBf = $service AND datesaveBf LIKE '{$divCon}%'";
            $conI = "serviceV = $service AND datemadeV LIKE '{$divCon}%'";
            $conA = "serviceR = $service AND datemadeR LIKE '{$divCon}%'";
            $conSt = "serviceSt = $service AND datesaveSt LIKE '{$divCon}%'";
            $conPr = "servicePr = $service AND datesavePr LIKE '{$divCon}%'";
            $conC = "serviceC = $service AND datemadeC LIKE '{$divCon}%'";
            $conAc = "servicePay = $service AND tablePay = 'commande' AND datemadePay LIKE '{$divCon}%'";
            $con = "serviceDp = $service AND datemadeDp LIKE '{$divCon}%'";
            $conAd = "servicePay = $service AND tablePay = 'depense' AND datemadePay LIKE '{$divCon}%'";
        } else {
            $conP = "serviceP = $service";
            $conBf = "serviceBf = $service";
            $conI = "serviceV = $service";
            $conA = "serviceR = $service";
            $conSt = "serviceSt = $service";
            $conPr = "servicePr = $service";
            $conC = "serviceC = $service";
            $conAc = "servicePay = $service AND tablePay = 'commande'";
            $con = "serviceDp = $service";
            $conAd = "servicePay = $service AND tablePay = 'depense'";
        }
    ?>
    <div class="bord">
        <div class="bord-left">
            <?php
                if (($_SESSION['poste'] !== 3) && ($_SESSION['poste'] !== 4)) {
            ?>
            <!-- Points -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Points</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Montant total :
                        <b class="red">
                            <?php
                                $sumMtt = sumDon('points', 'mttP', $conP);
                                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtt;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Montant versé :
                        <b class="red">
                            <?php
                                $sumMtv = sumDon('points', 'mtvP', $conP);
                                $totalMtv = number_format($sumMtv, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtv;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Manquant total :
                        <b class="blue">
                            <?php
                                $sumMk = sumDon('points', 'mankP', $conP);
                                $totalMk = number_format($sumMk, 0, ' ', ' ') . ' FCFA';
                                echo $totalMk;
                            ?>
                        </b>
                    </p>
                    
                    <div style="text-align: right;margin-top: 10px;">
                        <a href="points.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>

            <!-- Bénéfices -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Bénéfices</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Montant des ventes :
                        <b class="red">
                            <?php
                                $sumMtv = sumDon('benefice', 'mtvBf', $conBf);
                                $totalMtv = number_format($sumMtv, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtv;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Montant des achats :
                        <b class="red">
                            <?php
                                $sumMta = sumDon('benefice', 'mtaBf', $conBf);
                                $totalMta = number_format($sumMta, 0, ' ', ' ') . ' FCFA';
                                echo $totalMta;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Bénéfice total :
                        <b class="blue">
                            <?php
                                $sumBef = $sumMtv - $sumMta;
                                $totalBef = number_format($sumBef, 0, ' ', ' ') . ' FCFA';
                                echo $totalBef;
                            ?>
                        </b>
                    </p>

                    <div style="text-align: right;margin-top: 10px;">
                        <a href="benefs.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>
        <?php } ?>

            <!-- Inventaires -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Ventes</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Montant des recettes :
                        <b class="red">
                            <?php
                                $sumMtt = sumDon('inventory', 'mttV', $conI);
                                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtt;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Montant reçu :
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
                    </p>

                    <p class="card-title">
                        Différence totale :
                        <b class="blue">
                            <?php
                                $sumRes = $sumMtt - $sumMtr;
                                $totalRes = number_format($sumRes, 0, ' ', ' ') . ' FCFA';
                                echo $totalRes;
                            ?>
                        </b>
                    </p>

                    <div style="text-align: right;margin-top: 10px;">
                        <a href="invents.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>

            <!-- Stocks -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Stocks</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Entrée en stock :
                        <b class="red">
                            <?php
                                $enstock = sumDon('stock', 'qteSt', $conSt);
                                
                                if ($enstock) {
                                    echo $enstock . ' boissons';
                                } else {
                                    echo '0 boissons';
                                }
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Sortie du stock :
                        <b class="red">
                            <?php
                                $sortie = sumDon('produit', 'qtePr', $conPr);
                                
                                if ($sortie) {
                                    echo $sortie . ' boissons';
                                } else {
                                    echo '0 boissons';
                                }
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Etat du stock :
                        <b class="blue">
                            <?php
                                $reste = $enstock - $sortie;
                                echo $reste . ' boissons';
                            ?>
                        </b>
                    </p>

                    <div style="text-align: right;margin-top: 10px;">
                        <a href="stocks.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>

            <!-- Commandes -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Commandes</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Montant total :
                        <b class="red">
                            <?php
                                $sumMtt = sumDon('commande', 'mttC', $conC);
                                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtt;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Montant réglé :
                        <b class="red">
                            <?php
                                $sumMtrf = sumDon('commande', 'mtrC', $conC); // Premiers paiements
                                // Autres paiements
                                $sumMtra = sumDon('paiement', 'mttPay', $conAc); 

                                $sumMtr = $sumMtrf + $sumMtra;
                                $totalMtr = number_format($sumMtr, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtr;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Reste à régler :
                        <b class="blue">
                            <?php
                                $sumRes = $sumMtt - $sumMtr;
                                $totalRes = number_format($sumRes, 0, ' ', ' ') . ' FCFA';
                                echo $totalRes;
                            ?>
                        </b>
                    </p>

                    <div style="text-align: right;margin-top: 10px;">
                        <a href="cmdes.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>

            <!-- Dépenses -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-main-title">Dépenses</h2>
                </div>
                <div class="card-content">
                    <p class="card-title">
                        Montant total :
                        <b class="red">
                            <?php
                                $sumMtt = sumDon('depense', 'mttDp', $con);
                                $totalMtt = number_format($sumMtt, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtt;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Montant réglé :
                        <b class="red">
                            <?php
                                $sumMtrf = sumDon('depense', 'mtrDp', $con); // Premiers paiements
                                // Autres paiements
                                $sumMtra = sumDon('paiement', 'mttPay', $conAd); 

                                $sumMtr = $sumMtrf + $sumMtra;
                                $totalMtr = number_format($sumMtr, 0, ' ', ' ') . ' FCFA';
                                echo $totalMtr;
                            ?>
                        </b>
                    </p>

                    <p class="card-title">
                        Reste à régler :
                        <b class="blue">
                            <?php
                                $sumRes = $sumMtt - $sumMtr;
                                $totalRes = number_format($sumRes, 0, ' ', ' ') . ' FCFA';
                                echo $totalRes;
                            ?>
                        </b>
                    </p>

                    <div style="text-align: right;margin-top: 10px;">
                        <a href="dpnses.php" class="btn-simple">Plus de détails</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bord-right">
            <div class="r-info">
                <h3>Stock par boisson</h3>

                <?php
                    $con = "SELECT 
                        s.serviceSt,
                        s.BoissonSt,
                        b.designB AS nom_boisson,
                        b.contenantB AS contenant,
                        s.total_qteSt AS quantite_stock,
                        COALESCE(p.total_qtePr, 0) AS quantite_utilisee,
                        (s.total_qteSt - COALESCE(p.total_qtePr, 0)) AS qte_restante
                    FROM
                        (-- Sous-requête pour sommer le stock initial
                         SELECT serviceSt, BoissonSt, SUM(qteSt) AS total_qteSt
                         FROM stock
                         WHERE serviceSt = 2
                         GROUP BY serviceSt, BoissonSt) s
                    LEFT JOIN
                        boisson b ON s.BoissonSt = b.idB
                    LEFT JOIN
                        (-- Sous-requête pour sommer les produits utilisés
                         SELECT boissonPr, SUM(qtePr) AS total_qtePr
                         FROM produit
                         GROUP BY boissonPr) p ON s.BoissonSt = p.boissonPr
                    ORDER BY
                        qte_restante ASC;  -- Trie du stock le plus élevé au plus faible";
                    
                    $donS = recupStock($con);

                    foreach ($donS as $res) {
                        // Récupérer le contenant
                        $cont = $res['contenant'];
                        $conCt = "idCt = $cont";
                        $donCt = recupDon('contenant', $conCt);
                        foreach ($donCt as $ct) {
                            $ctn = $ct['libelleCt'];
                        }
                ?>
                <div class="det">
                    <div class="det-left">
                        <i class="fa-solid fa-champagne-glasses"></i>
                    </div>
                    <div class="det-right">
                        <p><?= $res['nom_boisson']; ?></p>
                        
                        <span>
                            <?php
                                $resSt = $res['qte_restante'];

                                if ($resSt > 1) {
                                    echo $resSt . ' ' . $ctn . 's';
                                } else {
                                    echo $resSt . ' ' . $ctn;
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <?php } ?>

                <div style="text-align: center;margin-top: 20px;">
                    <a href="stocks.php" class="btn-simple">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>