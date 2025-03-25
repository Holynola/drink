<?php 

include '../control/infoSess.php';

include '../public/css/addUserCss.php'; 

?>

<script>
    function openPage2() {
        window.open("imagesB.php", "_blank");
    }

    function setImageName(imageName) {
        document.getElementById('imageName').value = imageName;
    }
</script>

<div class="top">
    <h4>Ajouter une boisson | <?= $lieu; ?></h4>
</div>

<div class="cotent">
    <div class="user">
        <div class="r-info">
            <form action="../control/addDrink.php" method="post">
                <div>
                    <button type="button" onclick="openPage2()">Sélectionnez l'image</button>
                    <label for="imageName"></label>
                    <input type="text" id="imageName" name="imageName" readonly required>
                </div>

                <div>
                    <label for="design">Nom de la boisson</label><br>
                    <input type="text" name="design" id="design" maxlength="100" required>
                </div>

                <div>
                    <label for="prixv">Prix de vente</label><br>
                    <input type="text" name="prixv" id="prixv" class="currency" autocomplete="off">
                </div>

                <div>
                    <label for="typeb">Type de boisson</label><br>
                    <select name="typeb" id="typeb" required>
                        <option value=""></option>
                        <?php
                            $donT = recupDon('bevanda');

                            foreach ($donT as $ty) {
                        ?>
                        <option value="<?= $ty['idBv']; ?>"><?= $ty['libelleBv']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="typec">Type de contenant</label><br>
                    <select name="typec" id="typec" required>
                        <option value=""></option>
                        <?php
                            $donC = recupDon('contenant');

                            foreach ($donC as $ct) {
                        ?>
                        <option value="<?= $ct['idCt']; ?>"><?= $ct['libelleCt']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="typemb">Type d'emballage</label><br>
                    <select name="typemb" id="typemb" required>
                        <option value=""></option>
                        <?php
                            $donE = recupDon('emballage');

                            foreach ($donE as $em) {
                        ?>
                        <option value="<?= $em['idEm']; ?>"><?= $em['libelleEm']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="nbrebout">Nombre de bouteilles par casier</label><br>
                    <input type="number" name="nbrebout" id="nbrebout" maxlength="3" required>
                </div>

                <div>
                    <label for="kit">Vendue en kit ?</label><br>
                    <select name="kit" id="kit" required>
                        <option value=""></option>
                        <option value="yes">Oui</option>
                        <option value="no">Non</option>
                    </select>
                </div>

                <div id="prixkit" style="display: none;">
                    <label for="prixk">Prix du kit</label><br>
                    <input type="text" name="prixk" id="prixk" class="currency" autocomplete="off" required>
                </div>

                <div id="btekit" style="display: none;">
                    <label for="nbrekit">Nombre de bouteilles par kit</label><br>
                    <input type="number" name="nbrekit" id="nbrekit" maxlength="2">
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../public/js/addKit.js"></script>