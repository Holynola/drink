<?php 

include '../control/infoSess.php';

include '../public/css/addUserCss.php'; 
?>

<div class="top">
    <i class="fa-solid fa-cubes"></i>
    <h4>Ajouter un fournisseur | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="user">
        <div class="r-info">
            <form action="../control/addFourn.php" method="post">
                <div>
                    <label for="four">Nom du fournisseur</label><br>
                    <input type="text" name="four" id="four" maxlength="100" required>
                </div>

                <div>
                    <label for="localisation">Localisation</label><br>
                    <input type="text" name="localisation" id="localisation" maxlength="150" required>
                </div>

                <div>
                    <label for="contact">Contact</label><br>
                    <input type="text" name="contact" id="contact" maxlength="10" required>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>