<?php 
include '../control/alert.php';
include '../control/infoSess.php';

include '../public/css/addUserCss.php'; 
?>

<script src="../public/js/verifpass.js"></script>

<div class="top">
    <h4>Ajouter un utilisateur | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="user">
        <div class="r-info">
            <form action="../control/addUs.php" method="post" id="addForm">
                <div>
                    <label for="titre">Titre</label><br>
                    <select name="titre" id="titre" required>
                        <option value=""></option>
                        <option value="monsieur">Monsieur</option>
                        <option value="madame">Madame</option>
                        <option value="mademoiselle">Mademoiselle</option>
                    </select>
                </div>

                <div>
                    <label for="nom">Nom</label><br>
                    <input type="text" name="nom" id="nom" maxlength="20" required>
                </div>

                <div>
                    <label for="prenoms">Prénoms</label><br>
                    <input type="text" name="prenoms" id="prenoms" maxlength="30" required>
                </div>

                <div>
                    <label for="contact">Contact</label><br>
                    <input type="text" name="contact" id="contact" maxlength="10" required>
                </div>

                <div>
                    <label for="poste">Poste</label><br>
                    <select name="poste" id="poste" required>
                        <option value=""></option>
                        <?php
                            $conP = "idPo != 5";
                            $donP = recupDon('poste', $conP);

                            foreach ($donP as $pos) {
                        ?>
                        <option value="<?= $pos['idPo']; ?>"><?= $pos['libellePo']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="username">Identifiant</label><br>
                    <input type="text" name="username" id="username" maxlength="30" required>
                </div>

                <div>
                    <label for="pass">Mot de passe</label><br>
                    <input type="password" name="pass" id="pass" autocomplete="off" minlength="4" required>
                </div>

                <div>
                    <label for="confpass">Confirmation du Mot de passe</label><br>
                    <input type="password" name="confpass" id="confpass" autocomplete="off" minlength="4" required>
                </div>

                <div>
                    <button type="submit" name="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>