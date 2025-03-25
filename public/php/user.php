<?php

include '../control/alert.php';
include '../control/infoSess.php';
?>

<style>

tr th:nth-child(3),
tr td:nth-child(3) {
    color: var(--rouge);
}

tr th:nth-child(4),
tr td:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Utilisateurs | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div"></div>

    <div class="add-btn">
        <a href="addUsers.php" class="btn-link">Ajouter un utilisateur</a>
    </div>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date d'enregistrement</th>
                <th>Nom et Prénoms</th>
                <th>Poste</th>
                <th>Statut du compte</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conU = "posteU != 5 AND (serviceU = $service OR serviceU = 3) AND statutU != 'DEL'";
                $donU = recupDon('users', $conU);

                foreach ($donU as $user) {
            ?>
            <tr>
                <!-- Date d'enregistrement -->
                <td>
                    <?php
                        $dateEng = $user['datesaveU'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Nom et Prénoms -->
                <td><?= $user['nomU'] . ' ' . $user['prenomsU']; ?></td>
                
                <!-- Poste -->
                <td>
                    <?php
                        $poste = $user['posteU'];
                        affPoste($poste);
                    ?>
                </td>
                
                <!-- Statut du compte -->
                <td>
                    <?php
                        $statut = $user['statutU'];
                        affStatut($statut);
                    ?>
                </td>
                
                <td>
                    <a href="infosUser.php?id=<?= $user['idU']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>