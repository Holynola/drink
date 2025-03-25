<?php 
include '../control/infoSess.php';

include '../public/css/addUserCss.php';
include '../public/css/addCmdeCss.php'; 
?>

<div class="top">
    <h4>Faire un point | <?= $lieu; ?></h4>
</div>

<div class="content">
    <div class="cmd">
        <div class="cmd-left">
            <!-- Ventes -->
            <h5>Ventes</h5>

            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>21 Février</p>
                </div>
                <div class="red">
                    <span>Montant vente :</span>
                    <p>50 000 FCFA</p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>45 000 FCFA</p>
                </div>
                <div>
                    <span>Caissier/ière</span>
                    <p>Laurette</p>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Montant total de vente :</span>
                    <p class="red">50 000 FCFA</p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">45 000 FCFA</p>
                </div>
            </div>

            <!-- Règlements -->
            <h5>Règlements</h5>

            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>21 Février</p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>10 000 FCFA</p>
                </div>
                <div>
                    <span>Reçu par :</span>
                    <p>Jean</p>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Montant total des règlements :</span>
                </div>

                <div>
                    <p class="red">10 000 FCFA</p>
                </div>
            </div>

            <!-- Montant reçu -->
            <h5>
                Montant total reçu :
                <span class="red">55 000 FCFA</span>
            </h5>

            <!-- Commandes -->
            <h5>Commandes</h5>

            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>21 Février</p>
                </div>
                <div class="red">
                    <span>Montant commande :</span>
                    <p>50 000 FCFA</p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>5 000 FCFA</p>
                </div>
                <div>
                    <span>Effectuée par :</span>
                    <p>Arnaud</p>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Montant total des commandes :</span>
                    <p class="red">50 000 FCFA</p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">5 000 FCFA</p>
                </div>
            </div>

            <!-- Dépenses -->
            <h5>Dépenses</h5>

            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>21 Février</p>
                </div>
                <div class="red">
                    <span>Montant dépensé :</span>
                    <p>5 000 FCFA</p>
                </div>
                <div class="red">
                    <span>Montant réglé :</span>
                    <p>5 000 FCFA</p>
                </div>
                <div>
                    <span>Détail :</span>
                    <p>Achat de glaçons</p>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Montant total des dépenses :</span>
                    <p class="red">5 000 FCFA</p>
                </div>
                <div>
                    <span>Montant total réglé :</span>
                    <p class="red">5 000 FCFA</p>
                </div>
            </div>

            <!-- Paiements -->
            <h5>Paiements</h5>

            <div class="info-cmd">
                <div>
                    <span>Date :</span>
                    <p>21 Février</p>
                </div>
                <div>
                    <span>Libellé :</span>
                    <p>Commande</p>
                </div>
                <div class="red">
                    <span>Montant payé :</span>
                    <p>15 000 FCFA</p>
                </div>
                <div>
                    <span>Effectué par :</span>
                    <p>Charles</p>
                </div>
            </div>

            <div class="info-cmd">
                <div>
                    <span>Montant total des paiements :</span>
                </div>

                <div>
                    <p class="red">15 000 FCFA</p>
                </div>
            </div>

            <!-- Montant déepnsé -->
            <h5>
                Montant total dépensé :
                <span class="red">25 000 FCFA</span>
            </h5>
        </div>
        <div class="cmd-right">
            <div class="user">
                <div class="r-info">
                    <form action="#">
                        <div>
                            <label for="mtt">Montant à recevoir</label><br>
                            <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="mtv">Montant versé</label><br>
                            <input type="text" name="mtv" id="mtv" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="mank">Manquant</label><br>
                            <input type="text" name="mank" id="mank" class="currency" autocomplete="off" required>
                        </div>

                        <div>
                            <label for="det">Observation</label><br>
                            <textarea name="det" id="det"></textarea>
                        </div>

                        <div>
                            <label for="getby">Gérant(e)</label><br>
                            <select name="getby" id="getby" required>
                                <option value=""></option>
                                
                            </select>
                        </div>

                        <div>
                            <label for="madeby">Gestionnaire</label><br>
                            <select name="madeby" id="madeby" required>
                                <option value=""></option>
                                
                            </select>
                        </div>

                        <div>
                            <label for="datemade">Date du point</label>
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