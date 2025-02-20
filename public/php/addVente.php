<?php include '../public/css/addUserCss.php'; ?>
<?php include '../public/css/addCmdeCss.php'; ?>

<div class="top">
    <i class="fa-solid fa-sack-dollar"></i>
    <h4>Ajouter une vente</h4>
</div>

<div class="content">
    <div class="cmd">
        <div class="cmd-left">
            <div class="left-content">
                <div class="left-one">
                    <div>
                        <span>Nom de la boisson :</span>
                        <p class="blue">Chill</p>
                    </div>

                    <div>
                        <span>En stock :</span>
                        <p class="blue">90 Bouteilles</p>
                    </div>
                </div>

                <div class="left-two">
                    <div class="user">
                        <div class="r-info" style="line-height: 28px;">
                            <div>
                                <label for="getName">Choisir la boisson</label>
                                    <select name="getName" id="getName" required>
                                        <option value=""></option>
                                        
                                    </select>
                            </div>

                            <div>
                                <label for="getChoice">Kit ou détail</label>
                                    <select name="getChoice" id="getChoice" required>
                                        <option value=""></option>
                                        
                                    </select>
                            </div>

                            <div>
                                <label for="qte">Quantité</label>
                                <input type="number" name="qte" id="qte">
                            </div>

                            <div style="margin: 20px 0 30px;">
                                <a href="#" class="btn-link">Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Boisson :</span>
                    <p>Chill</p>
                </div>
                <div class="red">
                    <span>Kit ou détail :</span>
                    <p>Détail</p>
                </div>
                <div>
                    <span>Quantité :</span>
                    <p>10</p>
                </div>
                <div class="red">
                    <span>Montant</span>
                    <p>5 000 FCFA</p>
                </div>
            </div>
        </div>

        <div class="cmd-right">
            <div class="user">
                <div class="r-info">
                    <form action="#">
                        <div>
                            <label for="mtt">Montant total</label><br>
                            <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="mtr">Montant réglé</label><br>
                            <input type="text" name="mtr" id="mtr" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="getby">Serveur/euse</label><br>
                            <input type="text" name="getby" id="getby" maxlength="10">
                        </div>

                        <div>
                            <label for="madeby">Caissier/ière</label><br>
                            <select name="madeby" id="madeby" required>
                                <option value=""></option>
                                
                            </select>
                        </div>

                        <div>
                            <label for="datemade">Date de vente</label>
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