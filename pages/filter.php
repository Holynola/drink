<div class="content">    
    <?php if (!empty($divCon)) { ?>
        <div class="add-filter">
            <?php
                if ($tri == "an") {
                    $period = "année";
                } else {
                    $period = $tri;
                }
            ?>
            <span>Tri par <?= $period; ?> : </span>
            <span>
                <?php
                    if ($tri == "an") {
                        echo $divCon;
                    } else {
                        $dateTri = extraireMoisFR($divCon);
                        echo $dateTri;
                    }
                ?>
            </span>
        </div>
    <?php } ?>
</div>