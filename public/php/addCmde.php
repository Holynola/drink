<?php 

include '../control/infoSess.php';

include '../public/css/addUserCss.php';
include '../public/css/addCmdeCss.php'; 
?>

<div class="top">
    <i class="fa-solid fa-handshake-simple"></i>
    <h4>Ajouter une commande | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="cmd">
        <div class="cmd-left" id="tab">
            <div class="user">
                <div class="r-info" style="line-height: 28px;">
                    <div>
                        <label for="getName">Choisir la boisson</label>
                            <select name="getName" id="getName" required>
                                <option value=""></option>
                                <?php
                                    $conB = "serviceB = $service AND statutB = 'ON' ORDER BY designB ASC";
                                    $donB = recupDon('boisson', $conB);

                                    foreach ($donB as $bs) {
                                ?>
                                <option value="<?= $bs['idB']; ?>"><?= $bs['designB']; ?></option>
                                <?php } ?>
                            </select>
                    </div>

                    <div>
                        <label for="prixa">Prix du casier/carton</label>
                        <input type="number" name="prixa" id="prixa">
                    </div>

                    <div>
                        <label for="qte">Quantité</label>
                        <input type="number" name="qte" id="qte">
                    </div>

                    <div style="margin: 20px 0 30px;">
                        <a href="#" id="ajouter" class="btn-link">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Champ caché pour stocker les données des lignes ajoutées -->
        <input type="hidden" name="lignes" id="lignes">

        <div class="cmd-right">
            <div class="user">
                <div class="r-info">
                    <form action="../control/addCmd.php" id="commandeForm" method="post">
                        <div>
                            <label for="mtt">Montant total</label><br>
                            <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" readonly required>
                        </div>

                        <div>
                            <label for="mtr">Montant réglé</label><br>
                            <input type="text" name="mtr" id="mtr" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="four">Fournisseur</label><br>
                            <select name="four" id="four" required>
                                <option value=""></option>
                                <?php
                                    $conF = "statutF = 'ON'";
                                    $donF = recupDon('fournisseur', $conF);

                                    foreach ($donF as $four) {
                                ?>
                                <option value="<?= $four['idF'] ?>"><?= $four['nomF']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="facture">Facture</label><br>
                            <input type="text" name="facture" id="facture" maxlength="10">
                        </div>

                        <div>
                            <label for="madeby">Effectuée par</label><br>
                            <select name="madeby" id="madeby" required>
                                <option value=""></option>
                                <?php
                                    $conU = "posteU != 5 AND statutU != 'DEL'";
                                    $donU = recupDon('users', $conU);

                                    foreach ($donU as $us) {
                                ?>
                                <option value="<?= $us['idU']; ?>"><?= $us['nomU'] . ' ' . $us['prenomsU']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label for="datemade">Date de commande</label>
                            <input type="date" name="datemade" id="datemade">
                        </div>

                        <div>
                            <button type="submit" id="eng">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../public/js/affCmd.js"></script>