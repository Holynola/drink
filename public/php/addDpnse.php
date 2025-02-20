<?php include '../public/css/addUserCss.php'; ?>

<div class="top">
    <i class="fa-solid fa-coins"></i>
    <h4>Ajouter une dépense</h4>
</div>

<div class="content">
    <div class="user">
        <div class="r-info">
            <form action="#">
                <div>
                    <label for="mtt">Montant</label><br>
                    <input type="text" name="mtt" id="mtt" class="currency" autocomplete="off" required>
                </div>

                <div>
                    <label for="reg">Montant réglé</label><br>
                    <input type="text" name="reg" id="reg" class="currency" autocomplete="off">
                </div>

                <div>
                    <label for="det">Détail</label><br>
                    <textarea name="det" id="det" required></textarea>
                </div>

                <div>
                    <label for="madeby">Effectuée par</label><br>
                    <select name="madeby" id="madeby" required>
                        <option value=""></option>
                        
                    </select>
                </div>

                <div>
                    <label for="datemade">Date de dépense</label>
                    <input type="date" name="datemade" id="datemade">
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>