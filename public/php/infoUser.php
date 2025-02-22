<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: ../users.php");
}

include '../public/css/infoCss.php';
?>

<div class="top">
    <h4>Informations sur l'utilisateur | <?= $lieu; ?></h4>
</div>

<div class="info">
    <div class="info-left">
        <?php
            $conU = "idU = $id";
            $donU = recupDon('users', $conU);

            foreach ($donU as $user) {
        ?>
        <div class="left-content">
            <div class="left-box">
                <span>Lieu de travail :</span>
                <span>
                    <?php
                        $service = $user['serviceU'];
                        affService($service);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Nom :</span>
                <span><?= $user['nomU']; ?></span>
            </div>

            <div class="left-box">
                <span>Prénoms :</span>
                <span><?= $user['prenomsU'] ?></span>
            </div>

            <div class="left-box">
                <span>Poste :</span>
                <span>
                    <?php
                        $poste = $user['posteU'];
                        affPoste($poste);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Contact :</span>
                <span><?= $user['contactU']; ?></span>
            </div>

            <!-- Séparateur -->
            <div class="left-sep"></div>

            <div class="left-box">
                <span>Identifiant :</span>
                <span><?= $user['userU']; ?></span>
            </div>

            <div class="left-box">
                <span>Statut du compte :</span>
                <span>
                    <?php
                        $statut = $user['statutU'];
                        affStatut($statut);
                    ?>
                </span>
            </div>

            <div class="left-box">
                <span>Enregistré par :</span>
                <span>
                    <?php
                        $saveby = $user['savebyU'];
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
                        $dateEng = $user['datesaveU'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </span>
            </div>
        </div>
        <?php } ?>

        <div class="left-mdf">
            <h5>Modifié le :</h5>

            <?php
                $condi = "tableM = 'users' AND idtableM = $id";
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

                    <span class="title">Auteur :</span>
                    <span class="perso">
                        <?php
                            $auteurN = $mdf['auteurM'];
                            $cond = "idU = $auteurN";
                            $donU = recupDon('users', $cond);

                            if ($donU) {
                                foreach ($donU as $auteur) {
                                    echo $auteur['nomU'] . ' ' . $auteur['prenomU'];
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

    <div class="info-right"></div>
</div>