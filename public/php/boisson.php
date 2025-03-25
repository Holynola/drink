<?php
include '../control/alert.php';
include '../control/infoSess.php';

include '../public/css/boissonCss.php'; 
?>

<div class="top">
    <h4>Boissons | <?= $lieu; ?></h4>
</div>

<div class="add-tri">
    <div class="tri-div">
        <span>Trier :</span>
        <select name="choix" id="choix">
            <option value=""></option>
        </select>
    </div>

    <div class="add-btn">
        <a href="addBoixons.php" class="btn-link">Ajouter une boisson</a>
    </div>
</div>

<div class="content">
    <div class="drink">
        <?php
            $conB = "serviceB = $service AND statutB = 'ON' ORDER BY designB ASC";
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