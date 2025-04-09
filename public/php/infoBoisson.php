<?php

include '../control/infoSess.php';

if (isset($_GET['idB'])) {
    $id = $_GET['idB'];
} else {
    header("Location: boissons.php");
}

include '../public/css/infoCss.php';

$prixvB; // Prix de vente
$kit; // Vendu en kit
$prixkitB; // Prix du kit
$btlekit; // Nombre de boisson par kit
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
        <img src="/boisson/<?= $bs['imageB']; ?>" alt="<?= $bs['imageB']; ?>">

        <div class="left-mdf">
            <h5>Modifié le :</h5>

            <?php
                $condi = "tableM = 'boisson' AND idtableM = $id";
                $donMdf = recupDon('modif', $condi);

                if ($donMdf) {
                    foreach ($donMdf as $mdf) {
            ?>
            <div class="mdf-content">
                <div class="mdf-left">
                    <span class="title">
                        <?php
                            $dateEnr = $mdf['datesaveM'];
                            $dateF = extraireDateFR($dateEnr);
                            
                            $heureF = addHeure($dateEnr);
                            
                            echo $dateF . ' ' . $heureF;
                        ?>
                    </span>
                </div>
                <div class="mdf-right">
                    <span class="title">Action :</span><br>
                    <span class="perso"><?= $mdf['actionM']; ?></span><br>

                    <span class="title">Auteur :</span><br>
                    <span class="perso">
                        <?php
                            $auteurN = $mdf['auteurM'];
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
                    echo "<div style='text-align: center; font-size: 18px; font-weight: 600;'>Aucune modification</div>";
                }
            ?>
        </div>
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
                <span>
                    <?php
                        $btlekit = $bs['btekitB'];
                        echo $btlekit;
                    ?>
                </span>
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

        <form action="../control/mdfBxon.php?idB=<?=$id?>" method="post" id="mdfPrix" style="display: none;">
            <div>
                <label for="prixv">Prix de vente</label><br>
                <input type="text" name="prixv" id="prixv" value="<?= $prixvB; ?>" class="currency" autocomplete="off">
            </div>

            <?php
                if ((isset($kit)) && ($kit !== '')) {
                    $choixKit = $kit;
                }
            ?>
            <div>
                <label for="kit">Vendue en kit ?</label><br>
                <select name="kit" id="kit" required>
                    <option value=""></option>
                    <option value="yes" <?php echo ($choixKit == 'yes') ? 'selected' : ''; ?>>Oui</option>
                    <option value="no" <?php echo ($choixKit == 'no') ? 'selected' : ''; ?>>Non</option>
                </select>
            </div>

            <?php 
                if ((isset($prixkitB)) && ($prixkitB !== '')) {
                    $prixkitBs = $prixkitB;
                }
            ?>
            <div id="prixkit">
                <label for="prixk">Prix du kit</label><br>
                <input type="text" name="prixk" id="prixk" value="<?= $prixkitBs; ?>" class="currency" autocomplete="off" required>
            </div>

            <?php 
                if ((isset($btlekit)) && ($btlekit !== '')) {
                    $btlekits = $btlekit;
                }
            ?>
            <div id="btekit">
                <label for="nbrekit">Nombre de bouteilles par kit</label><br>
                <input type="number" name="nbrekit" value="<?= $btlekits ?>" id="nbrekit" maxlength="2">
            </div>

            <div>
                <button type="submit" class="btn-link">Enregistrer</button>
            </div>
        </form>

        <!-- Séparateur -->
        <div class="left-sep"></div>

        <div class="btn-div">
            <a href="#" id="btnPrix">Modifier le prix</a>
        </div>

        <div class="btn-div">
            <a href="../control/delDrink.php?idB=<?=$id;?>" onclick="return confirmLink()" class="red">Supprimer la boisson</a>
        </div>
    </div>

</div>

<script src="../public/js/conf.js"></script>
<script src="../public/js/affForm.js"></script>
<script src="../public/js/addKit.js"></script>