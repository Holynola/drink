<?php

include '../control/infoSess.php';

if (isset($_GET['idB'])) {
    $id = $_GET['idB'];
} else {
    header("Location: boissons.php");
}

include '../public/css/infoCss.php';
?>

<div class="top">
    <h4>Informations sur la boisson | <?= $lieu; ?></h4>
</div>

<div class="info">
    <?php
        $conB = "idB = $id";
        $donB = recupDon('boisson', $conB);

        foreach ($donB as $bs) {
    ?>
    <div class="info-left">
        <img src="../src/boisson/<?= $bs['imageB']; ?>" alt="<?= $bs['imageB']; ?>">
    </div>

    <div class="info-right">
        <div class="left-content">
            <div class="left-box">
                <span>Lieu de travail :</span>
                <span>
                    <?php
                        $service = $bs['serviceB'];
                        affService($service);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Nom de la boisson :</span>
                <span><?= $bs['designB']; ?></span>
            </div>

            <div class="left-box">
                <span>Prix de vente :</span>
                <span>
                    <?php
                        $prixv = $bs['prixvB'];
                        $prixvB = number_format($prixv, 0, ' ', ' ') . ' FCFA';
                        echo $prixvB;
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Type de boisson :</span>
                <span>
                    <?php
                        $typeb = $bs['typeB'];
                        $conT = "idBv = $typeb";
                        $donT = recupDon('bevanda', $conT);

                        foreach ($donT as $bv) {
                            echo $bv['libelleBv'];
                        }
                    ?>
                </span>
            </div>

            <?php
                // Contenant
                $typec = $bs['contenantB'];
                $conC = "idCt = $typec";
                $donC = recupDon('contenant', $conC);
                $ctn;

                foreach ($donC as $ct) {
                    $ctn = $ct['libelleCt'];
                }

                // Emballage
                $typemb = $bs['emballageB'];
                $conE = "idEm = $typemb";
                $donE = recupDon('emballage', $conE);
                $emb;

                foreach ($donE as $em) {
                    $emb = $em['libelleEm'];
                }
            ?>
            <div class="left-box">
                <span><?= "Nombre de " . $ctn . "s par " . $emb . "s :"; ?></span>
                <span><?= $bs['nbreB']; ?></span>
            </div>

            <div class="left-box">
                <span>Vendu en kit :</span>
                <span>
                    <?php
                        $kit = $bs['kitB'];

                        if ($kit == 'yes') {
                            echo "Oui";
                        } elseif ($kit == 'no') {
                            echo "Non";
                        } else {
                            echo "Erreur";
                        }
                    ?>
                </span>
            </div>
            
            <?php if ($kit == 'yes') { // Si la boisson est vendu en kit ?>
            <div class="left-box">
                <span>Prix du kit :</span>
                <span>
                    <?php
                        $prixkit = $bs['prixkitB'];
                        $prixkitB = number_format($prixkit, 0, ' ', ' ') . ' FCFA';
                        echo $prixkitB;
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span><?= "Nombre de " . $ctn . "s par kit :" ?></span>
                <span><?= $bs['btekitB']; ?></span>
            </div>
            <?php } ?>

            <!-- Séparateur -->
            <div class="left-sep"></div>

            <div class="left-box">
                <span>Enregistrée par :</span>
                <span>
                    <?php
                        $saveby = $bs['savebyB'];
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
                        $dateEnr = $bs['datesaveB'];
                        $dateF = extraireDateFR($dateEnr);
                        
                        $heureF = addHeure($dateEnr);
                        
                        echo $dateF . ' ' . $heureF;
                    ?>
                </span>
            </div>
        </div>
    <?php } ?>
        <!-- Séparateur -->
        <div class="left-sep"></div>

        <div class="btn-div">
            <a href="../control/delDrink.php?idB=<?=$id;?>" onclick="return confirmLink()" class="red">Supprimer la boisson</a>
        </div>
    </div>

</div>

<script src="../public/js/conf.js"></script>