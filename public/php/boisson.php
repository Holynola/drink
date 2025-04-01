<?php
include '../control/alert.php';
include '../control/infoSess.php';

include '../public/css/boissonCss.php'; 

if (isset($_GET['tri'])) {
    if ($_GET['tri'] == "tous") {
        $divCon = "";
    } else {
        $divCon = $_GET['tri'];
    }
} else {
    $divCon = "";
}

?>

<div class="top">
    <h4>Boissons | <?= $lieu; ?></h4>
</div>

<script src="../public/js/getBv.js"></script>

<div class="add-tri">
    <div class="tri-div">
        <span>Trier par type :</span>
        <select name="choix" id="choix">
            <option value="tous">Tous</option>
            <?php
                $donBv = recupDon('bevanda');

                foreach ($donBv as $bv) {
            ?>
            <option value="<?=$bv['idBv'];?>" <?php echo ($divCon == $bv['idBv']) ? 'selected' : ''; ?>><?= $bv['libelleBv']; ?></option>
        <?php } ?>
        </select>
    </div>

    <div class="add-btn">
        <a href="addBoixons.php" class="btn-link">Ajouter une boisson</a>
    </div>
</div>

<div class="content">
    <!-- Condition de tri des boissons -->
    <?php
        if (!empty($divCon)) {
            $conB = "serviceB = $service AND statutB = 'ON' AND typeB = $divCon ORDER BY designB ASC";
        } else {
            $conB = "serviceB = $service AND statutB = 'ON' ORDER BY designB ASC";
        }
    ?>
    <div class="drink">
        <?php
            $donB = recupDon('boisson', $conB);

            foreach ($donB as $bs) {
        ?>
        <div class="drink-card">
            <div class="drink-img">
                <img src="/boisson/<?= $bs['imageB']; ?>" alt="<?= $bs['imageB']; ?>">
            </div>
            <div class="drink-txt">
                <span><?= $bs['designB']; ?></span>
                <div>
                    Prix de vente :<br>
                    <span>
                        <?php
                            $prixv = $bs['prixvB'];
                            $prixvB = number_format($prixv, 0, ' ', ' ') . ' FCFA';
                            echo $prixvB;
                        ?>
                    </span>
                </div>
                <div>
                    <a href="infosBoisson.php?idB=<?= $bs['idB']; ?>" class="btn-small">Plus d'infos</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>