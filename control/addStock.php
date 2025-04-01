<?php

include 'dbConf.php';
include 'recupAll.php';
include 'sumAll.php';
include 'recupStk.php';

$service = $_SESSION['service'];

?>

<style>
    
.stock-epuise {
    background-color: #ffdddd; /* Rouge clair pour stock épuisé */
    color: #cc0000;
    font-weight: bold;
}
.stock-faible {
    background-color: #fff3cd; /* Jaune clair pour stock faible */
    color: #856404;
}

.add-filter,
.recap {
    display: none;
}

</style>

<div class="content" id="stock">
    <!-- Condition de tri du stock -->
    <?php
        $conS = "SELECT 
                    s.serviceSt,
                    s.BoissonSt,
                    b.designB,
                    b.contenantB,
                    SUM(s.qteSt) AS total_qteSt
                FROM 
                    stock s
                LEFT JOIN 
                    boisson b ON s.BoissonSt = b.idB
                WHERE 
                    s.serviceSt = $service
                GROUP BY 
                    s.serviceSt, 
                    s.BoissonSt
                ORDER BY 
                    (SUM(s.qteSt) - IFNULL((SELECT SUM(p.qtePr) FROM produit p WHERE p.boissonPr = s.BoissonSt AND p.servicePr = s.serviceSt), 0)) ASC";
    ?>
    <table>
        <thead>
            <tr>
                <th>Boisson</th>
                <th>Entrée en stock</th>
                <th>Sortie du stock</th>
                <th>Etat du stock</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $donS = recupStock($conS);

                foreach ($donS as $stk) {
                    // Récupérer le contenant
                    $cont = $stk['contenantB'];
                    $conCt = "idCt = $cont";
                    $donCt = recupDon('contenant', $conCt);
                    foreach ($donCt as $ct) {
                        $ctn = $ct['libelleCt'];
                    }
                    
                    // Calcul des quantités
                    $stock = $stk['total_qteSt'];
                    $boissonId = $stk['BoissonSt'];
                    $conP = "boissonPr = $boissonId AND servicePr = $service";
                    $vendu = sumDon('produit', 'qtePr', $conP) ?? 0;
                    $etat = $stock - $vendu;
                    
                    // Déterminer la classe CSS en fonction de l'état du stock
                    $classeEtat = '';
                    if ($etat <= 0) {
                        $classeEtat = 'stock-epuise';
                    } elseif ($etat < 5) { // Vous pouvez ajuster ce seuil
                        $classeEtat = 'stock-faible';
                    }
            ?>
            <tr class="<?= $classeEtat ?>">
                <!-- Boisson -->
                <td><?= $stk['designB']; ?></td>
                
                <!-- Entrée en stock -->
                <td>
                    <?= $stock > 1 ? $stock . ' ' . $ctn . 's' : $stock . ' ' . $ctn ?>
                </td>
                
                <!-- Sortie du stock -->
                <td>
                    <?= $vendu > 1 ? $vendu . ' ' . $ctn . 's' : $vendu . ' ' . $ctn ?>
                </td>
                
                <!-- Etat du stock -->
                <td>
                    <?= $etat > 1 ? $etat . ' ' . $ctn . 's' : $etat . ' ' . $ctn ?>
                </td>
                
                <td>
                    <a href="infosStock.php?idB=<?= $stk['BoissonSt']; ?>&design=<?= $stk['designB']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>