<?php

include '../control/alert.php';
include '../control/infoSess.php';
include '../control/recupStk.php';

include 'triCon.php';
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
    <h4>Stock | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="#" id="triStk" class="btn-link">Trier par stock</a>
        <a href="addStock.php" class="btn-link">Ajouter un stock</a>
    </div>
</div>

<?php include 'filter.php'; ?>

<script src="../public/js/getTri.js"></script>
<script src="../public/js/getFilter.js"></script>
<script src="../public/js/getStock.js"></script>

<div class="content" id="stock">
    <!-- Condition de tri du stock -->
    <?php
        if (!empty($divCon)) {
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
                        s.serviceSt = $service AND s.datesaveSt LIKE '{$divCon}%'
                    GROUP BY 
                        s.serviceSt, 
                        s.BoissonSt";

            $conSt = "serviceSt = $service AND datesaveSt LIKE '{$divCon}%'";
            $conPr = "servicePr = $service AND datesavePr LIKE '{$divCon}%'";
        } else {
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
                        s.BoissonSt";

            $conSt = "serviceSt = $service";
            $conPr = "servicePr = $service";
        }
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
            ?>
            <tr>
                <!-- Boisson -->
                <td><?= $stk['designB']; ?></td>
                
                <!-- Entrée en stock -->
                <td>
                    <?php
                        $stock = $stk['total_qteSt'];

                        if ($stock > 1) {
                            echo $stock . ' ' . $ctn . 's';
                        } else {
                            echo $stock . ' ' . $ctn;
                        }
                    ?>
                </td>
                
                <!-- Sortie du stock -->
                <td>
                    <?php
                        $boissonId = $stk['BoissonSt'];
                        $conP = "boissonPr = $boissonId AND servicePr = $service";
                        $vendu = sumDon('produit', 'qtePr', $conP);

                        if ($vendu == null) {
                            $vendu = 0;
                        }

                        if ($vendu > 1) {
                            echo $vendu . ' ' . $ctn . 's';
                        } else {
                            echo $vendu . ' ' . $ctn;
                        }
                    ?>
                </td>
                
                <!-- Etat du stock -->
                <td>
                    <?php
                        $etat = $stock - $vendu;

                        if ($etat > 1) {
                            echo $etat . ' ' . $ctn . 's';
                        } else {
                            echo $etat . ' ' . $ctn;
                        }
                    ?>
                </td>
                
                <td>
                    <a href="infosStock.php?idB=<?= $stk['BoissonSt']; ?>&design=<?= $stk['designB']; ?>">Plus de détails</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Stocks</h5>
    
    <div>
        Entrée en stock :
        <b class="red">
            <?php
                $enstock = sumDon('stock', 'qteSt', $conSt);
                
                if ($enstock) {
                    echo $enstock . ' boissons';
                } else {
                    echo '0 boissons';
                }
            ?>
        </b>
    </div>

    <div>
        Sortie du stock :
        <b class="red">
            <?php
                $sortie = sumDon('produit', 'qtePr', $conPr);
                
                if ($sortie) {
                    echo $sortie . ' boissons';
                } else {
                    echo '0 boissons';
                }
            ?>
        </b>
    </div>

    <div>
        Etat du stock :
        <b class="blue">
            <?php
                $reste = $enstock - $sortie;
                echo $reste . ' boissons';
            ?>
        </b>
    </div>
</div>