<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: invents.php");
}

include '../public/css/infoCss.php';

$point; // Récupérer la valeur de la colonne point
?>

<div class="top">
    <h4>Informations l'inventaire | <?= $lieu; ?></h4>
</div>

<div class="info">
    <div class="info-left">
        <?php
            $montantV;
            $conV = "idV = $id";
            $donV = recupDon('inventory', $conV);

            foreach ($donV as $iv) {
        ?>
        <div class="left-content">
            <div class="left-box">
                <span>Lieu de travail :</span>
                <span>
                    <?php
                        $service = $iv['serviceV'];
                        affService($service);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Montant de la recette :</span>
                <span>
                    <?php
                        $mont = $iv['mttV'];
                        $mtt = number_format($mont, 0, ' ', ' ') . ' FCFA';
                        echo $mtt;
                    ?>
                </span>
            </div>

            <?php if ($iv['detailV'] !== null) { ?>
            <div class="left-box">
                <span>Détails :</span>
                <span><?= $iv['detailV']; ?></span>
            </div>
            <?php } ?>

            <?php if ($iv['getbyV'] !== null) { ?>
            <div class="left-box">
                <span>Caissier/ière :</span>
                <span>
                    <?php
                        $getby = $iv['getbyV'];
                        $conU = "idU = $getby";
                        $donU = recupDon('users', $conU);
                        foreach ($donU as $use) {
                            echo $use['nomU'] . ' ' . $use['prenomsU'];
                        }
                    ?>
                </span>
            </div>
            <?php } ?>

            <div class="left-box">
                <span>Effectué par :</span>
                <span>
                    <?php
                        $madeby = $iv['madebyV'];
                        $conUs = "idU = $madeby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Date d'inventaire :</span>
                <span>
                    <?php
                        $dateMade = $iv['datemadeV'];
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
                        $saveby = $iv['savebyV'];
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
                        $dateEnr = $iv['datesaveV'];
                        $dateF = extraireDateFR($dateEnr);
                        
                        $heureF = addHeure($dateEnr);
                        
                        echo $dateF . ' ' . $heureF;
                    ?>
                </span>
            </div>
        </div>
        <?php
                $montantV = $iv['mttV'];
                $point = $iv['pointV'];
            }
        ?>

        <div class="left-mdf">
            <h5>Montants reçus :</h5>

            <?php
                $mtregle; // Premier versement
                $conM = "idV = $id";
                $donM = recupDon('inventory', $conM);

                foreach ($donM as $mtr) {
                    if ($mtr['mtrV'] > 0) {
            ?>
            <div class="mdf-content">
                <div class="mdf-left">
                    <span class="title">
                        <?php
                            $dateEnr = $mtr['datemadeV'];
                            $dateF = extraireDateFR($dateEnr);
                            echo $dateF;
                        ?>
                    </span>
                </div>
                <div class="mdf-right">
                    <span class="title">Montant :</span><br>
                    <span class="perso">
                        <?php
                            $montr = $mtr['mtrV'];
                            $mttr = number_format($montr, 0, ' ', ' ') . ' FCFA';
                            echo $mttr;
                        ?>
                    </span><br>

                    <span class="title">Reçu par :</span><br>
                    <span class="perso">
                        <?php
                            $auteurN = $mtr['madebyV'];
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
                        $mtregle = $mtr['mtrV'];
                    }
                }
            ?>

            <?php
                // Récupération des autres réglèments
                $conR = "ventR = $id";
                $donR = recupDon('reglement', $conR);

                if ($donR) {
                    foreach ($donR as $reg) {
            ?>
            <div class="mdf-content">
                <div class="mdf-left">
                    <span class="title">
                        <?php
                            $dateMde = $reg['datemadeR'];
                            $dateF = extraireDateFR($dateMde);
                            echo $dateF;
                        ?>
                    </span>
                </div>
                <div class="mdf-right">
                    <span class="title">Montant :</span><br>
                    <span class="perso">
                        <?php
                            $mttPay = $reg['mttR'];
                            $mtPay = number_format($mttPay, 0, ' ', ' ') . ' FCFA';
                            echo $mtPay;
                        ?>
                    </span><br>

                    <span class="title">Reçu par :</span><br>
                    <span class="perso">
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
                    </span>
                </div>
            </div>
            <?php
                    }
                } else {
                    if ($mtregle == 0) {
                        echo "<div style='text-align: center; font-size: 18px; font-weight: 600;'>Aucuns montants reçus</div>";
                    }
                }
            ?>
        </div>
    </div>

    <div class="info-right">
        <div class="left-content">
            <div class="left-box">
                <span>Montant total reçu :</span>
                <span>
                    <?php
                        $mtPay = sumDon('reglement', 'mttR', $conR);
                        $totalPay = $mtregle + $mtPay;
                        $ttPay = number_format($totalPay, 0, ' ', ' ') . ' FCFA';
                        echo $ttPay;
                    ?>
                </span>
            </div>
        </div>

        <div class="left-content">
            <div class="left-box">
                <span>Différence :</span>
                <span>
                    <?php
                        $reste = $montantV - $totalPay;
                        $rarPay = number_format($reste, 0, ' ', ' ') . ' FCFA';
                        echo $rarPay;
                    ?>
                </span>
            </div>
        </div>

        <!-- Séparateur -->
        <div class="left-sep"></div>

        <form action="../control/addReg.php?idV=<?= $id; ?>" method="post" id="mdfReg" style="display: none;">
            <div>
                <label for="mtt">Montant reçu</label><br>
                <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" required>
            </div>

            <div>
                <label for="madeby">Reçu par</label><br>
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
                <label for="datemade">Date de réglement</label>
                <input type="date" name="datemade" id="datemade">
            </div>

            <div>
                <button type="submit" class="btn-link">Ajouter</button>
            </div>
        </form>
        
        <?php if ($reste > 0) { ?>
        <div class="btn-div">
            <a href="#" class="red" id="btnReg">Ajouter un réglement</a>
        </div>
        <?php } ?>

        <?php if ($point == null) { ?>
        <div class="btn-div">
            <a href="#" onclick="return confirmLink()" class="red">Supprimer l'inventaire</a>
        </div>
        <?php } ?>
    </div>

    <div class="info-left">
        <div class="left-mdf">
            <h5>Détails :</h5>
        </div>

        <?php
            $conP = "ventPr = $id AND servicePr = $service";
            $donP = recupDon('produit', $conP);

            foreach ($donP as $pr) {
        ?>
        <div class="info-cmd">
            <div>
                <span>Boisson</span>
                <p>
                    <?php
                        $idB = $pr['boissonPr'];
                        $conB = "idB = $idB AND serviceB = $service";
                        $donB = recupDon('boisson', $conB);
                        foreach ($donB as $bs) {
                            echo $bs['designB'];
                        }
                    ?>
                </p>
            </div>
            <div>
                <span>Quantité (Nombre de bouteilles)</span>
                <p><?= $pr['qtePr']; ?></p>
            </div>
            <div class="red">
                <span>Montant</span>
                <p>
                    <?php
                        $mttB = $pr['mttPr'];
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