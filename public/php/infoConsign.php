<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: consigns.php");
}

include '../public/css/infoCss.php';

$statut; // Statut de la boisson
?>

<div class="top">
    <h4>Informations sur la consignation | <?= $lieu; ?></h4>
</div>

<div class="info">
    <div class="info-left">
        <?php
            $conC = "idCs = $id";
            $donC = recupDon('consign', $conC);

            foreach ($donC as $cs) {
        ?>
        <div class="left-content">
            <div class="left-box">
                <span>Lieu de travail :</span>
                <span>
                    <?php
                        $service = $cs['serviceCs'];
                        affService($service);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Boisson :</span>
                <span>
                    <?php
                        $idB = $cs['boissonCs'];
                        $conB = "idB = $idB";
                        $donB = recupDon('boisson', $conB);

                        foreach ($donB as $bs) {
                            echo $bs['designB'];
                        }
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Nombre de bouteilles :</span>
                <span><?= $cs['nbrebteCs']; ?></span>
            </div>

            <?php if ($cs['detailCs'] !== null) { ?> 
            <div class="left-box">
                <span>Détails :</span>
                <span><?= $cs['detailCs']; ?></span>
            </div>
            <?php } ?>

            <div class="left-box">
                <span>Enregistrée par :</span>
                <span>
                    <?php
                        $saveby = $cs['savebyCs'];
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
                        $dateEnr = $cs['datesaveCs'];
                        $dateF = extraireDateFR($dateEnr);
                        
                        $heureF = addHeure($dateEnr);
                        
                        echo $dateF . ' ' . $heureF;
                    ?>
                </span>
            </div>

            <!-- Séparateur -->
            <div class="left-sep"></div>

            <div class="left-box">
                <span>Statut :</span>
                <span>
                    <?php
                        $statut = $cs['statutCs'];

                        if ($statut == "OK") {
                            echo "Récupéré par le client";
                        } else {
                            echo "En stock";
                        }
                    ?>
                </span>
            </div>

            <?php if ($statut == "OK") { ?>
            <div class="left-box">
                <span>Récupéré par :</span>
                <span>
                    <?php
                        $madeby = $cs['madebyCs'];
                        $conUs = "idU = $madeby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Date de récupération :</span>
                <span>
                    <?php
                        $dateMade = $cs['datemadeCs'];
                        $dateFR = extraireDateFR($dateMade);
                        $heureFR = addHeure($dateMade);
                        echo $dateFR . ' ' . $heureFR;
                    ?>
                </span>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>

    <?php if ($statut == "KO") { ?>
    <div class="info-right">
        <div class="btn-div">
            <a href="../control/mdfCons.php?id=<?= $id; ?>" onclick="return confirmLink()" class="red">Récupérer la consignation</a>
        </div>

        <div class="btn-div">
            <a href="../control/delCons.php?id=<?= $id; ?>" onclick="return confirmLink()" class="red">Supprimer la consignation</a>
        </div>
    </div>
    <?php } ?>
</div>

<script src="../public/js/conf.js"></script>