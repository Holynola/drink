<?php

include '../control/infoSess.php';
?>

<style>

tr th:nth-child(1),
tr td:nth-child(1) {
    color: var(--rouge);
}

tr th:nth-child(5),
tr td:nth-child(5) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Historique de connexion | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date de connexion</th>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Contact</th>
                <th>Poste</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conLg = "(serviceLg = $service OR serviceLg = 3) AND posteLg != 5 ORDER BY datesaveLg DESC";
                $donLg = recupDon('logs', $conLg);

                foreach ($donLg as $lg) {
            ?>
            <tr>
                <!-- Date de connexion -->
                <td>
                    <?php
                        $datesave = $lg['datesaveLg'];
                        $saveDate = extraireDateFR($datesave);
    
                        $saveHour = addHeure($datesave);
    
                        echo $saveDate . ' ' . $saveHour;
                    ?>
                </td>
                
                <?php
                    $id = $lg['userLg'];

                    $condi = "idU = $id";
                    $donU = recupDon('users', $condi);

                    foreach ($donU as $us) {
                ?>
                <!-- Nom -->
                <td><?= $us['nomU']; ?></td>
                
                <!-- Prénoms -->
                <td><?= $us['prenomsU']; ?></td>
                
                <!-- Contact -->
                <td><?= $us['contactU']; ?></td>

                <?php } ?>
                
                <!-- Poste -->
                <td>
                    <?php
                        $poste = $lg['posteLg'];
                        affPoste($poste);

                        $posteD = $poste;
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>