<?php include '../public/css/BoissonCss.php'; ?>

<div class="top">
    <i class="fa-solid fa-champagne-glasses"></i>
    <h4>Boissons</h4>
</div>

<div class="add-tri">
    <div class="tri-div">
        <span>Trier :</span>
        <select name="choix" id="choix">
            <option value=""></option>
        </select>
    </div>

    <div class="add-btn">
        <a href="addBoixons.php" class="btn-link">Ajouter une boisson</a>
    </div>
</div>

<div class="content">
    <div class="drink">
        <div class="drink-card">
            <div class="drink-img">
                <img src="../src/img/Awa.jpg" alt="Boisson">
            </div>
            <div class="drink-txt">
                <span>Nom de la boisson</span>
                <div>Prix de vente : <span>50 000 FCFA</span></div>
                <div>En Stock : <span>50 Bouteilles</span></div>
            </div>
        </div>
    </div>
</div>