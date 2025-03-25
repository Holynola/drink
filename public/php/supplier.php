<?php

include '../control/alert.php';
include '../control/infoSess.php';
?>
<style>

tr th:nth-child(2),
tr td:nth-child(2) {
    color: var(--rouge);
}

tr th:nth-child(4),
tr td:nth-child(4) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Fournisseurs | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div"></div>

    <div class="add-btn">
        <a href="addFours.php" class="btn-link">Ajouter un fournisseur</a>
    </div>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date d'enregistrement</th>
                <th>Nom du fournisseur</th>
                <th>Localisation</th>
                <th>Contact</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conF = "statutF = 'ON' ORDER BY nomF ASC";
                $donF = recupDon('fournisseur', $conF);

                foreach ($donF as $four) {
            ?>
            <tr>
                <!-- Date d'enregistrement -->
                <td>
                    <?php
                        $dateEng = $four['datesaveF'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Nom du fournisseur -->
                <td><?= $four['nomF']; ?></td>
                
                <!-- Localisation -->
                <td><?= $four['localF']; ?></td>
                
                <!-- Contact -->
                <td><?= $four['numF']; ?></td>
                
                <td>
                    <a href="../control/delFour.php?idt=<?= $four['idF']; ?>" onclick="return confirmLink()">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="../public/js/conf.js"></script>