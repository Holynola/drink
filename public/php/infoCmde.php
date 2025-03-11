<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: cmdes.php");
}

include '../public/css/infoCss.php';

$point; // Récupérer la valeur de la colonne point
?>

<div class="top">
    <h4>Informations sur la commande | <?= $lieu; ?></h4>
</div>

<div class="info">
    <div class="info-left">
        <?php
            $montantC;
            $conC = "idC = $id";
            $donC = recupDon('commande', $conC);

            foreach ($donC as $cmd) {
        ?>
        <div class="left-content">
            <div class="left-box">
                <span>Lieu de travail :</span>
                <span>
                    <?php
                        $service = $cmd['serviceC'];
                        affService($service);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Montant total :</span>
                <span>
                    <?php
                        $mont = $cmd['mttC'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Fournisseur :</span>
                <span>
                    <?php
                        $four = $cmd['fourC'];
                        $conF = "idF = $four";
                        $donF = recupDon('fournisseur', $conF);
                        foreach ($donF as $fr) {
                            echo $fr['nomF'];
                        }
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Facture :</span>
                <span><?= $cmd['factureC']; ?></span>
            </div>

            <div class="left-box">
                <span>Effectuée par :</span>
                <span>
                    <?php
                        $madeby = $cmd['madebyC'];
                        $conUs = "idU = $madeby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Date de commande :</span>
                <span>
                    <?php
                        $dateMade = $cmd['datemadeC'];
                        $dateFR = extraireDateFR($dateMade);
                        echo $dateFR;
                    ?>
                </span>
            </div>

            <!-- Séparateur -->
            <div class="left-sep"></div>

            <div class="left-box">
                <span>Enregistrée par :</span>
                <span>
                    <?php
                        $saveby = $cmd['savebyC'];
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
                        $dateEnr = $cmd['datesaveC'];
                        $dateF = extraireDateFR($dateEnr);
                        
                        $heureF = addHeure($dateEnr);
                        
                        echo $dateF . ' ' . $heureF;
                    ?>
                </span>
            </div>
        </div>
        <?php
                $montantC = $cmd['mttC'];
                $point = $cmd['pointC']; 
            } 
        ?>

        <div class="left-mdf">
            <h5>Paiements :</h5>

            <?php
                $mtrgle; // Premier paiement
                $conM = "idC = $id";
                $donM = recupDon('commande', $conM);

                foreach ($donM as $mtr) {
                    if ($mtr['mtrC'] > 0) {
            ?>
            <div class="mdf-content">
                <div class="mdf-left">
                    <span class="title">
                        <?php
                            $dateEnr = $mtr['datemadeC'];
                            $dateF = extraireDateFR($dateEnr);
                            echo $dateF;
                        ?>
                    </span>
                </div>
                <div class="mdf-right">
                    <span class="title">Montant réglé :</span><br>
                    <span class="perso">
                        <?php
                            $montr = $mtr['mtrC'];
                            $mttr = number_format($montr, 0, ' ', ' ') . ' FCFA';
                            echo $mttr;
                        ?>
                    </span><br>

                    <span class="title">Effectué par :</span><br>
                    <span class="perso">
                        <?php
                            $auteurN = $mtr['madebyC'];
                            $cond = "idU = $auteurN";
                            $donU = recupDon('users', $cond);

                            if ($donU) {
                                foreach ($donU as $auteur) {
                                    echo $auteur['nomU'] . ' ' . $auteur['prenomsU'];
                                }
                            }
                        ?>
                    </span>
                </div>
            </div>
            <?php
                        $mtrgle = $mtr['mtrC'];
                    }
                } 
            ?>

            <!-- Récypération des autres paiemens -->
            <?php
                $conP = "idTablePay = $id AND tablePay = 'commande'";
                $donP = recupDon('paiement', $conP);

                if ($donP) {
                    foreach ($donP as $pay) {
            ?>
            <div class="mdf-content">
                <div class="mdf-left">
                    <span class="title">
                        <?php
                            $dateMde = $pay['datemadePay'];
                            $dateF = extraireDateFR($dateMde);
                            echo $dateF;
                        ?>
                    </span>
                </div>
                <div class="mdf-right">
                    <span class="title">Montant réglé :</span><br>
                    <span class="perso">
                        <?php
                            $mttPay = $pay['mttPay'];
                            $mtPay = number_format($mttPay, 0, ' ', ' ') . ' FCFA';
                            echo $mtPay;
                        ?>
                    </span><br>

                    <span class="title">Effectué par :</span><br>
                    <span class="perso">
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
                    </span>
                </div>
            </div>
            <?php
                    }
                } else {
                    if ($mtrgle == 0) {
                        echo "<div style='text-align: center; font-size: 18px; font-weight: 600;'>Aucun paiement</div>";
                    }
                }
            ?>
        </div>
    </div>

    <div class="info-right">
        <div class="left-content">
            <div class="left-box">
                <span>Montant total réglé :</span>
                <span>
                    <?php
                        $mtPay = sumDon('paiement', 'mttPay', $conP);
                        $totalPay = $mtrgle + $mtPay;
                        $ttPay = number_format($totalPay, 0, ' ', ' ') . ' FCFA';
                        echo $ttPay;
                    ?>
                </span>
            </div>
        </div>

        <div class="left-content">
            <div class="left-box">
                <span>Reste à régler :</span>
                <span>
                    <?php
                        $reste = $montantC - $totalPay;
                        $rarPay = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rarPay;
                    ?>
                </span>
            </div>
        </div>

        <!-- Séparateur -->
        <div class="left-sep"></div>

        <form action="../control/addPay.php?idp=<?=$id;?>&pay=commande" method="post" id="mdfDpse" style="display: none;">
            <div>
                <label for="mtt">Montant réglé</label><br>
                <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" required>
            </div>

            <div>
                <label for="madeby">Effectué par</label><br>
                <select name="madeby" id="madeby" required>
                    <option value=""></option>
                    <?php
                        $conU = "posteU != 5 AND statutU != 'DEL'";
                        $donU = recupDon('users', $conU);

                        foreach ($donU as $user) {
                    ?>
                    <option value="<?= $user['idU'] ?>"><?= $user['nomU'] . ' ' . $user['prenomsU']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="datemade">Date de paiement</label>
                <input type="date" name="datemade" id="datemade">
            </div>

            <div>
                <button type="submit" class="btn-link">Ajouter</button>
            </div>
        </form>

        <?php if ($reste > 0) { ?>
        <div class="btn-div">
            <a href="#" class="red" id="btnDpse">Ajouter un paiement</a>
        </div>
        <?php } ?>

        <?php if ($point == null) { ?>
        <div class="btn-div">
            <a href="../control/delCmde.php?idC=<?= $id; ?>" onclick="return confirmLink()" class="red">Supprimer la commande</a>
        </div>
        <?php } ?>
    </div>

    <div class="info-left">
        <div class="left-mdf">
            <h5>Détails :</h5>
        </div>
        
        <?php
            $conS = "cmdSt = $id AND serviceSt = $service";
            $donS = recupDon('stock', $conS);

            foreach ($donS as $sto) {
        ?>
        <div class="info-cmd">
            <div>
                <span>Boisson</span>
                <p>
                    <?php
                        $idB = $sto['BoissonSt'];
                        $conB = "idB = $idB AND serviceB = $service";
                        $donB = recupDon('boisson', $conB);
                        foreach ($donB as $bs) {
                            echo $bs['designB'];
                        }
                    ?>
                </p>
            </div>
            <div class="red">
                <span>Prix du casier/carton</span>
                <p>
                    <?php
                        $prix = $sto['prixcSt'];
                        $prixc = number_format($prix, 0, ' ', ' ') . ' FCFA';
                        echo $prixc;
                    ?>
                </p>
            </div>
            <div>
                <span>Quantité</span>
                <p>
                    <?php
                        $qte = $sto['nbrecarsSt'];
                        echo $qte;
                    ?>
                </p>
            </div>
            <div class="red">
                <span>Montant</span>
                <p>
                    <?php
                        $mttB = $prix * $qte;
                        $mttBt = number_format($mttB, 0, ' ', ' ') . ' FCFA';
                        echo $mttBt;
                    ?>
                </p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script src="../public/js/conf.js"></script>
<script src="../public/js/affForm.js"></script>