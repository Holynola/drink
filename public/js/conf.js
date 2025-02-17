function confirmLink() {
    // Demande confirmation à l'utilisateur
    var confirmation = confirm("Êtes-vous sûr de vouloir effectuer cette action ?");

    // Annuler l'envoi du lien si l'utilisateur clique sur "Annuler"
    if (!confirmation) {
        return false;
    }

    // Autoriser l'envoi du lien si l'utilisateur clique sur "OK"
    return true;
}