<?php

include '../control/infoSess.php';

include '../public/css/addUserCss.php';
include '../public/css/addCmdeCss.php'; 
?>

<div class="top">
    <h4>Faire un point | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="cmd">
        <div class="cmd-left">
            <!-- Inventaires -->
            <h5>Inventaires</h5>

            <?php
                $conV = "serviceV = $service AND pointV IS NULL";
                $donV = recupDon('inventory', $conV);

                
                foreach ($donV as $iv) {
            ?>
            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>
                        <?php
                            $datemade = $iv['datemadeV'];
                            $dateFR = extraireDateFR($datemade);
                            echo $dateFR;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant vente :</span>
                    <p>
                        <?php
                            $mont = $iv['mttV'];
                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                            echo $mtt;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>
                        <?php
                            $reg = $iv['mtrV']; // Montant reçu
                            $mtr = number_format($reg, 0, ' ', ' ') . ' FCFA';
                            echo $mtr;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Effectué par :</span>
                    <p>
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
                    </p>
                </div>
            </div>
            <?php } ?>

            <div class="info-cmd">
                <div>
                    <span>Montant total de vente :</span>
                    <p class="red">
                        <?php
                            $sumMttV = sumDon('inventory', 'mttV', $conV);
                            $mttV = number_format($sumMttV, 0, ' ', ' ') . ' FCFA';
                            echo $mttV;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">
                        <?php
                            $sumMtrV = sumDon('inventory', 'mtrV', $conV);
                            $mtrV = number_format($sumMtrV, 0, ' ', ' ') . ' FCFA';
                            echo $mtrV;
                        ?>
                    </p>
                </div>
            </div>

            <!-- Règlements -->
            <h5>Règlements</h5>

            <?php
                $conR = "serviceR = $service AND pointR IS NULL";
                $donR = recupDon('reglement', $conR);

                foreach ($donR as $reg) {
            ?>
            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>
                        <?php
                            $dateMde = $reg['datemadeR'];
                            $dateF = extraireDateFR($dateMde);
                            echo $dateF;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>
                        <?php
                            $mttPay = $reg['mttR'];
                            $mtPay = number_format($mttPay, 0, ' ', ' ') . ' FCFA';
                            echo $mtPay;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Reçu par :</span>
                    <p>
                        <?php
                            $auteurN = $reg['madebyR'];
                            $cond = "idU = $auteurN";
                            $donU = recupDon('users', $cond);

                            if ($donU) {
                                foreach ($donU as $auteur) {
                                    echo $auteur['nomU'] . ' ' . $auteur['prenomsU'];
                                }
                            }
                        ?>
                    </p>
                </div>
            </div>
            <?php } ?>

            <div class="info-cmd">
                <div>
                    <span>Montant total des règlements :</span>
                </div>

                <div>
                    <p class="red">
                        <?php
                            $sumReg = sumDon('reglement', 'mttR', $conR);
                            $regV = number_format($sumReg, 0, ' ', ' ') . ' FCFA';
                            echo $regV;
                        ?>
                    </p>
                </div>
            </div>

            <!-- Montant reçu -->
            <h5>
                Montant total reçu :
                <span class="red">
                    <?php
                        $sumRec = $sumMtrV + $sumReg;
                        $recV = number_format($sumRec, 0, ' ', ' ') . ' FCFA';
                        echo $recV;
                    ?>
                </span>
            </h5>

            <!-- Commandes -->
            <h5>Commandes</h5>

            <?php
                $conC = "serviceC = $service AND pointC IS NULL";
                $donC = recupDon('commande', $conC);

                foreach ($donC as $cmd) {
            ?>
            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>
                        <?php
                            $datemade = $cmd['datemadeC'];
                            $dateFR = extraireDateFR($datemade);
                            echo $dateFR;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant commande :</span>
                    <p>
                        <?php
                            $mont = $cmd['mttC'];
                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                            echo $mtt;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>
                        <?php
                            $regC = $cmd['mtrC'];
                            $mttReg = number_format($regC, 0, ' ', ' ') . ' FCFA';
                            echo $mttReg;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Effectuée par :</span>
                    <p>
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
                    </p>
                </div>
            </div>
            <?php } ?>

            <div class="info-cmd">
                <div>
                    <span>Montant total des commandes :</span>
                    <p class="red">
                        <?php
                            $sumMttC = sumDon('commande', 'mttC', $conC);
                            $sumMttCF = number_format($sumMttC, 0, ' ', ' ') . ' FCFA';
                            echo $sumMttCF;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">
                        <?php
                            $sumMtrC = sumDon('commande', 'mtrC', $conC);
                            $sumMtrCF = number_format($sumMtrC, 0, ' ', ' ') . ' FCFA';
                            echo $sumMtrCF;
                        ?>
                    </p>
                </div>
            </div>

            <!-- Dépenses -->
            <h5>Dépenses</h5>

            <?php
                $conD = "serviceDp = $service AND pointDp IS NULL";
                $donD = recupDon('depense', $conD);

                foreach ($donD as $dp) {
            ?>
            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>
                        <?php
                            $datemade = $dp['datemadeDp'];
                            $dateFR = extraireDateFR($datemade);
                            echo $dateFR;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant dépensé :</span>
                    <p>
                        <?php
                            $mont = $dp['mttDp'];
                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                            echo $mtt;
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>
                        <?php
                            $regD = $dp['mtrDp']; // Premier montant réglé
                            $mtrD = number_format($regD, 0, ' ', ' ') . ' FCFA';
                            echo $mtrD;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Détail :</span>
                    <p><?= $dp['detailDp']; ?></p>
                </div>
            </div>
            <?php } ?>

            <div class="info-cmd">
                <div>
                    <span>Montant total des dépenses :</span>
                    <p class="red">
                        <?php
                            $sumMttD = sumDon('depense', 'mttDp', $conD);
                            $sumMttDF = number_format($sumMttD, 0, ' ', ' ') . ' FCFA';
                            echo $sumMttDF;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">
                        <?php
                            $sumMtrD = sumDon('depense', 'mtrDp', $conD);
                            $sumMtrDF = number_format($sumMtrD, 0, ' ', ' ') . ' FCFA';
                            echo $sumMtrDF;
                        ?>
                    </p>
                </div>
            </div>

            <!-- Paiements -->
            <h5>Paiements</h5>

            <?php
                $conP = "servicePay = $service AND pointPay IS NULL";
                $donP = recupDon('paiement', $conP);

                foreach ($donP as $pay) {
            ?>
            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>
                        <?php
                            $dateMde = $pay['datemadePay'];
                            $dateF = extraireDateFR($dateMde);
                            echo $dateF;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Libellé :</span>
                    <p>
                        <?php
                            $tableP = $pay['tablePay'];

                            if ($tableP == "depense") {
                                echo "Dépense";
                            } elseif ($tableP == "commande") {
                                echo "Commande";
                            } else {
                                echo "Erreur !!!";
                            }
                        ?>
                    </p>
                </div>
                <div class="red">
                    <span>Montant payé :</span>
                    <p>
                        <?php
                            $mttPay = $pay['mttPay'];
                            $mtPay = number_format($mttPay, 0, ' ', ' ') . ' FCFA';
                            echo $mtPay;
                        ?>
                    </p>
                </div>
                <div>
                    <span>Effectué par :</span>
                    <p>
                        <?php
                            $auteurN = $pay['madebyPay'];
                            $cond = "idU = $auteurN";
                            $donU = recupDon('users', $cond);

                            if ($donU) {
                                foreach ($donU as $auteur) {
                                    echo $auteur['nomU'] . ' ' . $auteur['prenomsU'];
                                }
                            }
                        ?>
                    </p>
                </div>
            </div>
            <?php } ?>

            <div class="info-cmd">
                <div>
                    <span>Montant total des paiements :</span>
                </div>

                <div>
                    <p class="red">
                        <?php
                            $sumPay = sumDon('paiement', 'mttPay', $conP);
                            $payV = number_format($sumPay, 0, ' ', ' ') . ' FCFA';
                            echo $payV;
                        ?>
                    </p>
                </div>
            </div>

            <!-- Montant dépensé -->
            <h5>
                Montant total dépensé :
                <span class="red">
                    <?php
                        $sumDp = $sumMtrC + $sumMtrD + $sumPay;
                        $sumDpV = number_format($sumDp, 0, ' ', ' ') . ' FCFA';
                        echo $sumDpV;
                    ?>
                </span>
            </h5>

            <div id="data-container" 
                 data-sum-rec="<?= htmlspecialchars($sumRec) ?>" 
                 data-sum-dp="<?= htmlspecialchars($sumDp) ?>">
            </div>
        </div>
        <div class="cmd-right">
            <div class="user">
                <div class="r-info">
                    <form action="../control/addPt.php" method="post">
                        <div>
                            <label for="mtt">Montant à recevoir</label><br>
                            <input type="text" name="mtt" id="mtt" readonly required>
                        </div>

                        <div>
                            <label for="mtv">Montant versé</label><br>
                            <input type="text" name="mtv" id="mtv" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="mank">Manquant</label><br>
                            <input type="text" name="mank" id="mank" readonly required>
                        </div>

                        <div>
                            <label for="det">Observation</label><br>
                            <textarea name="det" id="det"></textarea>
                        </div>

                        <div>
                            <label for="getby">Gérant(e)</label><br>
                            <select name="getby" id="getby" required>
                                <option value=""></option>
                                <?php
                                    $conU = "posteU = 3 AND serviceU = $service";
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
                                    $conUs = "posteU = 1 OR posteU = 2";
                                    $donUs = recupDon('users', $conUs);

                                    foreach ($donUs as $use) {
                                ?>
                                <option value="<?= $use['idU']; ?>"><?= $use['nomU'] . ' ' . $use['prenomsU']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="datemade">Date du point</label>
                            <input type="date" name="datemade" id="datemade" required>
                        </div>

                        <div>
                            <button type="submit" id="eng">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../public/js/calculPoint.js"></script>