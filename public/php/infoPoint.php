<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	header("Location: points.php");
}

include '../public/css/infoCss.php';
?>

<style>
	
.cmd-left h5 {
    font-size: 24px;
    margin-top: 20px;
}

</style>

<div class="top">
	<h4>Informations sur le point | <?= $lieu; ?></h4>
</div>

<div class="info">
	<div class="info-left">
		<?php
			$conP = "idP = $id";
			$donP = recupDon('points', $conP);

			foreach ($donP as $pt) {
		?>
		<div class="left-content">
			<div class="left-box">
				<span>Lieu de travail :</span>
				<span>
					<?php
						$service = $pt['serviceP'];
						affService($service);
					?>
				</span>
			</div>

			<div class="left-box">
				<span>Montant total :</span>
				<span>
					<?php
                        $mont = $pt['mttP'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
				</span>
			</div>

			<div class="left-box">
				<span>Montant reçu :</span>
				<span>
					<?php
                        $montv = $pt['mtvP'];
                        $mtv = number_format($montv, 0, ' ', ' ') . ' FCFA';
                        echo $mtv;
                    ?>
				</span>
			</div>

			<div class="left-box">
				<span>Manquant :</span>
				<span>
					<?php
                        $mk = $pt['mankP'];
                        $mank = number_format($mk, 0, ' ', ' ') . ' FCFA';
                        echo $mank;
                    ?>
				</span>
			</div>

			<?php if ($pt['observP'] !== '') { ?>
			<div class="left-box">
				<span>Observation :</span>
				<span><?= $pt['observP']; ?></span>
			</div>
			<?php } ?>

			<!-- Séparateur -->
            <div class="left-sep"></div>

			<div class="left-box">
				<span>Gérant(e) :</span>
				<span>
					<?php
                        $getby = $pt['getbyP'];
                        $conU = "idU = $getby";
                        $donU = recupDon('users', $conU);
                        foreach ($donU as $use) {
                            echo $use['nomU'] . ' ' . $use['prenomsU'];
                        }
                    ?>
				</span>
			</div>

			<div class="left-box">
				<span>Effectué par :</span>
				<span>
					<?php
                        $madeby = $pt['madebyP'];
                        $conUs = "idU = $madeby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
				</span>
			</div>

			<div class="left-box">
				<span>Date du point :</span>
				<span>
					<?php
                        $dateMade = $pt['datemadeP'];
                        $dateFR = extraireDateFR($dateMade);
                        echo $dateFR;
                    ?>
				</span>
			</div>

			<!-- Séparateur -->
            <div class="left-sep"></div>

			<div class="left-box">
				<span>Enregistré par :</span>
				<span>
					<?php
                        $saveby = $pt['savebyP'];
                        $conUs = "idU = $saveby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
				</span>
			</div>

			<div class="left-box">
				<span>Date d'enregistrement :</span>
				<span>
					<?php
                        $dateEnr = $pt['datesaveP'];
                        $dateF = extraireDateFR($dateEnr);
                        
                        $heureF = addHeure($dateEnr);
                        
                        echo $dateF . ' ' . $heureF;
                    ?>
				</span>
			</div>
		</div>
		<?php } ?>
	</div>

	<div class="info-right">
		<div class="btn-div">
			<a href="../control/delPoint.php?idP=<?=$id;?>" onclick="return confirmLink()" class="red">Supprimer le point</a>
		</div>
	</div>

	<div class="info-left">
		<div class="left-mdf">
			<h5>Détails :</h5>
		</div>

		<div class="cmd">
			<div class="cmd-left">
	            <!-- Inventaires -->
	            <h5>Inventaires</h5>

	            <?php
	                $conV = "serviceV = $service AND pointV = $id";
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
	                    <span>Montant vente</span>
	                    <p>
	                        <?php
	                            $mont = $iv['mttV'];
	                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
	                            echo $mtt;
	                        ?>
	                    </p>
	                </div>
	                <div class="red">
	                    <span>Montant réglé</span>
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
	                $conR = "serviceR = $service AND pointR = $id";
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
	                    <span>Montant réglé</span>
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
	                $conC = "serviceC = $service AND pointC = $id";
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
	                    <span>Montant commande</span>
	                    <p>
	                        <?php
	                            $mont = $cmd['mttC'];
	                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
	                            echo $mtt;
	                        ?>
	                    </p>
	                </div>
	                <div class="red">
	                    <span>Montant réglé</span>
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
	                $conD = "serviceDp = $service AND pointDp = $id";
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
	                    <span>Montant dépensé</span>
	                    <p>
	                        <?php
	                            $mont = $dp['mttDp'];
	                            $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
	                            echo $mtt;
	                        ?>
	                    </p>
	                </div>
	                <div class="red">
	                    <span>Montant réglé</span>
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
	                $conP = "servicePay = $service AND pointPay = $id";
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
	                    <span>Montant payé</span>
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
	        </div>
		</div>
	</div>
</div>

<script src="../public/js/conf.js"></script>