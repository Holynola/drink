<?php include '../public/css/addUserCss.php'; ?>

<div class="top">
    <i class="fa-solid fa-house-user"></i>
    <h4>Ajouter un stock</h4>
</div>

<div class="content">
    <p>NB : Cette rubrique est destinée au stock en dehors des commandes. Si le stock vient d'une commande, veuillez faire l'enregistrement dans le menu "Commandes". Si c'est un stock initial ou isolé, vous pouvez l'ajouter ici.</p>

    <div class="user">
        <div class="r-info">
            <form action="#">
                <div>
                    <label for="getName">Choisir la boisson</label>
                        <select name="getName" id="getName" required>
                            <option value=""></option>
                            
                        </select>
                </div>

                <div>
                    <label for="qte">Quantité</label>
                    <input type="number" name="qte" id="qte" required>
                </div>

                <div>
                    <label for="prixa">Prix d'achat par bouteille</label>
                    <input type="number" name="prixa" id="prixa" required>
                </div>

                <div>
                    <button type="submit" id="eng">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>