<?php

include '../control/alert.php';
include '../control/infoSess.php';
include '../control/recupStk.php';
?>
<style>

.all-div div:nth-child(4) {
    color: var(--rouge);
}

.all-div div:nth-child(3) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-house-user"></i>
    <h4>Stock | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div">
        <span>Trier :</span>
        <select name="choix" id="choix">
            <option value=""></option>
            <option value="tous">Tous</option>
            <option value="">Lieu de service</option>
        </select>

        <select name="result" id="result">
            <option value=""></option>
        </select>
    </div>

    <div class="add-btn">
        <a href="#" class="btn-link">Trier par stock</a>
        <a href="addStock.php" class="btn-link">Ajouter un stock</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Boisson</div>
                <div>Entrée en stock</div>
                <div>Sortie du stock</div>
                <div>Etat du stock</div>
                <div></div>
            </div>
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
                            s.BoissonSt";

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
            <div class="all-div atr">
                <!-- Boisson -->
                <div><?= $stk['designB']; ?></div>
                
                <!-- Entrée en stock -->
                <div>
                    <?php
                        $stock = $stk['total_qteSt'];

                        if ($stock > 1) {
                            echo $stock . ' ' . $ctn . 's';
                        } else {
                            echo $stock . ' ' . $ctn;
                        }
                    ?>
                </div>
                
                <!-- Sortie du stock -->
                <div>
                    <?php
                        $boissonId = $stk['BoissonSt'];
                        $conP = "boissonPr = $boissonId AND servicePr = $service";
                        $vendu = sumDon('produit', 'qtePr', $conP);

                        if ($vendu > 1) {
                            echo $vendu . ' ' . $ctn . 's';
                        } else {
                            echo $vendu . ' ' . $ctn;
                        }
                    ?>
                </div>
                
                <!-- Etat du stock -->
                <div>
                    <?php
                        $etat = $stock - $vendu;

                        if ($etat > 1) {
                            echo $etat . ' ' . $ctn . 's';
                        } else {
                            echo $etat . ' ' . $ctn;
                        }
                    ?>
                </div>
                
                <div>
                    <a href="infosStock.php?idB=<?= $stk['BoissonSt']; ?>&design=<?= $stk['designB']; ?>">Plus de détails</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Recap -->
<div class="recap">
    <h5>Récapitulatif des Stocks</h5>
    
    
    <div>
        Entrée en stock :
        <b class="red">
            <?php
                $conSt = "serviceSt = $service";
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
                $conPr = "servicePr = $service";
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