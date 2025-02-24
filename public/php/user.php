<?php

include '../control/alert.php';
include '../control/infoSess.php';
?>

<style>

.all-div div:nth-child(3) {
    color: var(--rouge);
}

.all-div div:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-users"></i>
    <h4>Utilisateurs | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div"></div>

    <div class="add-btn">
        <a href="addUsers.php" class="btn-link">Ajouter un utilisateur</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date d'enregistrement</div>
                <div>Nom et Prénoms</div>
                <div>Poste</div>
                <div>Statut du compte</div>
                <div></div>
            </div>
            <?php
                $conU = "posteU != 5 AND (serviceU = $service OR serviceU = 3) AND statutU != 'DEL'";
                $donU = recupDon('users', $conU);

                foreach ($donU as $user) {
            ?>
            <div class="all-div atr">
                <!-- Date d'enregistrement -->
                <div>
                    <?php
                        $dateEng = $user['datesaveU'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </div>
                
                <!-- Nom et Prénoms -->
                <div><?= $user['nomU'] . ' ' . $user['prenomsU']; ?></div>
                
                <!-- Poste -->
                <div>
                    <?php
                        $poste = $user['posteU'];
                        affPoste($poste);
                    ?>
                </div>
                
                <!-- Statut du compte -->
                <div>
                    <?php
                        $statut = $user['statutU'];
                        affStatut($statut);
                    ?>
                </div>
                
                <div>
                    <a href="infosUser.php?id=<?= $user['idU']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>