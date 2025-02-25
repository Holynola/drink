<?php

include '../control/infoSess.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: users.php");
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
        <!-- Modification du poste -->
        <form action="../control/mdfPste.php?idt=<?=$id?>" method="post" id="mdfPoste" style="display: none;">
            <div>
                <label for="poste">Poste</label><br>
                <select name="poste" id="poste" required>
                    <option value=""></option>
                    <?php
                        $conP = "idPo != 5";
                        $donP = recupDon('poste', $conP);

                        foreach ($donP as $pos) {
                    ?>
                    <option value="<?= $pos['idPo']; ?>"><?= $pos['libellePo']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div id="serviceDiv" style="display: none;">
                <label for="service">Lieu de travail</label><br>
                <select name="service" id="service">
                    <option value=""></option>
                    <?php
                        $conW = "idW != 3";
                        $donW = recupDon('work', $conW);

                        foreach ($donW as $wk) {
                    ?>
                    <option value="<?= $wk['idW']; ?>"><?= $wk['libelleW']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <button type="submit" class="btn-link">Modifier</button>
            </div>
        </form>

        <!-- Modification de l'identifiant -->
        <form action="../control/mdfIdentf.php?idt=<?=$id?>" method="post" id="mdfIdentf" style="display: none;">
            <div>
                <label for="username">Identifiant</label><br>
                <input type="text" name="username" id="username" maxlength="30" required>
            </div>

            <div>
                <button type="submit" class="btn-link">Modifier</button>
            </div>
        </form>

        <!-- Modification du mot de passe -->
        <form action="../control/mdfPswd.php?idt=<?=$id?>" method="post" id="mdfPass" style="display: none;">
            <div>
                <label for="pass">Mot de passe</label><br>
                <input type="password" name="password" id="password" autocomplete="off" minlength="4" required>
            </div>

            <div>
                <button type="submit" class="btn-link">Modifier</button>
            </div>
        </form>

        <div class="all-btn">
            <div class="btn-div">
                <?php
                    if ($statut == 'OFF') {
                    ?>
                        <a href="../control/mdfStt.php?idt=<?=$id?>&statut=<?=$statut?>" onclick="return confirmLink()" class="btn-simple">Activer le compte</a>
                    <?php    
                    } elseif ($statut == 'ON') {
                    ?>
                        <a href="../control/mdfStt.php?idt=<?=$id?>&statut=<?=$statut?>" onclick="return confirmLink()" class="btn-simple">Désactiver le compte</a>
                    <?php
                    }
                ?>
            </div>

            <div class="btn-div">
                <button id="btnPoste" class="btn-simple">Modifier le poste</button>
            </div>

            <div class="btn-div">
                <button id="btnIdentf" class="btn-simple">Modifier l'identifiant</button>
            </div>

            <div class="btn-div">
                <button id="btnPass" class="btn-simple">Modifier le mot de passe</button>
            </div>

            <div class="btn-div">
                <a href="../control/delUser.php?idt=<?=$id?>" onclick="return confirmLink()" class="red">Supprimer le compte</a>
            </div>
        </div>
    </div>
</div>

<script src="../public/js/conf.js"></script>
<script src="../public/js/affForm.js"></script>