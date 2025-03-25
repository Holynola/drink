<?php

include '../control/infoSess.php';
?>
<style>

tr th:nth-child(2),
tr td:nth-child(2) {
    color: var(--rouge);
}

tr th:nth-child(3),
tr td:nth-child(3) {
    color: var(--bleu);
}

</style>

<div class="top">
    <h4>Points | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addPoints.php" class="btn-link">Faire un point</a>
    </div>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date du point</th>
                <th>Montant total</th>
                <th>Montant versé</th>
                <th>Manquant</th>
                <th>Gérant</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>20 Février 2025</td>
                <td>200 000 FCFA</td>
                <td>195 000 FCFA</td>
                <td>5 000 FCFA</td>
                <td>Charles Yao</td>
                <td>
                    <a href="#">Plus de détails</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>