<?php 
include '../control/infoSess.php';
include '../control/recupStk.php';

include '../public/css/addUserCss.php'; 
?>

<div class="top">
    <h4>Faire une consignation | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="user">
        <div class="r-info">
            <form action="../control/addCnsign.php" method="post">
                <div>
                    <label for="boisson">Choisir la boisson</label>
                    <select name="boisson" id="boisson" required>
                        <option value=""></option>
                        <?php
                            $conS = "SELECT 
                                        s.BoissonSt,
                                        b.idB,
                                        b.designB
                                    FROM 
                                        stock s
                                    LEFT JOIN 
                                        boisson b ON s.BoissonSt = b.idB
                                    WHERE 
                                        s.serviceSt = $service
                                    GROUP BY 
                                        s.BoissonSt, b.idB, b.designB;";
                            
                            $donB = recupStock($conS);

                            foreach ($donB as $bs) {
                        ?>
                        <option value="<?= $bs['idB']; ?>"><?= $bs['designB']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="nbrebte">Nombre de bouteilles</label><br>
                    <input type="number" name="nbrebte" id="nbrebte" maxlength="3" required>
                </div>

                <div>
                    <label for="det">Détails</label><br>
                    <textarea name="det" id="det"></textarea>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>