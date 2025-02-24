<?php

include '../control/infoSess.php';
?>

<style>

.all-div div:nth-child(1) {
    color: var(--rouge);
}

.all-div div:nth-child(5) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-coins"></i>
    <h4>Historique de connexion | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date de connexion</div>
                <div>Nom</div>
                <div>Prénoms</div>
                <div>Contact</div>
                <div>Poste</div>
            </div>
            <?php
                $conLg = "posteLg != 5 ORDER BY datesaveLg DESC";
                $donLg = recupDon('logs', $conLg);

                foreach ($donLg as $lg) {
            ?>
            <div class="all-div atr">
                <!-- Date de connexion -->
                <div>
                    <?php
                        $datesave = $lg['datesaveLg'];
                        $saveDate = extraireDateFR($datesave);
    
                        $saveHour = addHeure($datesave);
    
                        echo $saveDate . ' ' . $saveHour;
                    ?>
                </div>
                
                <?php
                    $id = $lg['userLg'];

                    $condi = "idU = $id";
                    $donU = recupDon('users', $condi);

                    foreach ($donU as $us) {
                ?>
                <!-- Nom -->
                <div><?= $us['nomU']; ?></div>
                
                <!-- Prénoms -->
                <div><?= $us['prenomsU']; ?></div>
                
                <!-- Contact -->
                <div><?= $us['contactU']; ?></div>

                <?php } ?>
                
                <!-- Poste -->
                <div>
                    <?php
                        $poste = $lg['posteLg'];
                        affPoste($poste);

                        $posteD = $poste;
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>