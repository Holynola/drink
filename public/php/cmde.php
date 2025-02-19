<style>

.all-div div:nth-child(2) {
    color: var(--rouge);
}

.all-div div:nth-child(3) {
    color: var(--bleu);
}

</style>

<div class="top">
    <i class="fa-solid fa-handshake-simple"></i>
    <h4>Commandes</h4>
</div>

<div class="add-tri">
    <?php include 'triDiv.php'; ?>

    <div class="add-btn">
        <a href="addCmdes.php" class="btn-link">Ajouter une commande</a>
    </div>
</div>

<div class="all">
    <div class="content">
        <div class="all-content">
            <div class="all-div ett">
                <div>Date de commande</div>
                <div>Montant</div>
                <div>Effectuée par</div>
                <div>Fournisseur</div>
                <div></div>
            </div>
            <div class="all-div atr">
                <div>19 Février 2025</div>
                <div>50 000 FCFA</div>
                <div>Axel Jean</div>
                <div>Dépot du commerce</div>
                <div>
                    <a href="#">Plus de détails</a>
                </div>
            </div>
        </div>
    </div>
</div>