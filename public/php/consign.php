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
    <h4>Consignations de boisson | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addConsigns.php" class="btn-link">Faire une consignation</a>
    </div>
</div>

<div class="content">
    <table>
        <thead>
            <tr>
                <th>Date d'enregistrement</th>
                <th>Boisson</th>
                <th>Nombre de bouteilles</th>
                <th>Statut</th>
                <th>Enregistrée par</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conC = "serviceCs = $service";
                $donC = recupDon('consign', $conC);

                foreach ($donC as $csn) {
            ?>
            <tr>
                <!-- Date d'enregistrement -->
                <td>
                    <?php
                        $dateEng = $csn['datesaveCs'];
                        $dateFR = extraireDateFR($dateEng);
                        echo $dateFR;
                    ?>
                </td>
                
                <!-- Boisson -->
                <td>
                    <?php
                        $idB = $csn['boissonCs'];
                        $conB = "idB = $idB";
                        $donB = recupDon('boisson', $conB);

                        foreach ($donB as $bs) {
                            echo $bs['designB'];
                        }
                    ?>
                </td>
                
                <!-- Nombre de bouteilles -->
                <td><?= $csn['nbrebteCs'] ?></td>
                
                <!-- Statut -->
                <td>
                    <?php
                        $statut = $csn['statutCs'];

                        if ($statut == "OK") {
                            echo "Récupéré par le client";
                        } else {
                            echo "En stock";
                        }
                    ?>
                </td>
                
                <!-- Enregistrée par -->
                <td>
                    <?php
                        $saveby = $csn['savebyCs'];
                        $conUs = "idU = $saveby";
                        $donUs = recupDon('users', $conUs);
                        foreach ($donUs as $us) {
                            echo $us['nomU'] . ' ' . $us['prenomsU'];
                        }
                    ?>
                </td>
                
                <td>
                    <a href="infosConsign.php?id=<?= $csn['idCs']; ?>">Plus de détails</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Consignations</h5>

    <div>
        Nombre total :
        <b class="red">
            <?php
                $sumBte = sumDon('consign', 'nbrebteCs', $conC);

                if ($sumBte) {
                    echo $sumBte . ' bouteilles';    
                } else {
                    echo '0 bouteilles';
                }
            ?>
        </b>
    </div>

    <div>
        Nombre récupéré :
        <b class="red">
            <?php
                $conCo = "serviceCs = $service AND statutCs = 'OK'";
                $sumOk = sumDon('consign', 'nbrebteCs', $conCo);

                if ($sumOk) {
                    echo $sumOk . ' bouteilles';
                } else {
                    echo '0 bouteilles';
                }
            ?>
        </b>    
    </div>

    <div>
        En stock :
        <b class="blue">
            <?php
                $conCk = "serviceCs = $service AND statutCs = 'KO'";
                $somKo = sumDon('consign', 'nbrebteCs', $conCk);

                if ($somKo) {
                    echo $somKo . ' bouteilles';    
                } else {
                    echo '0 bouteilles';
                }
            ?>
        </b>
    </div>
</div>