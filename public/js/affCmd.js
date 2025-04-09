$(document).ready(function() {
    let lignes = []; // Tableau pour stocker les lignes ajoutées
    let montantTotal = 0; // Variable pour stocker le montant total

    $('#ajouter').click(function(e) {
        e.preventDefault();

        // Récupérer les valeurs saisies
        var boissonId = $('#getName').val(); // Récupère la valeur (nombre)
        var boissonText = $('#getName option:selected').text(); // Récupère le texte de l'option
        var prix = parseFloat($('#prixa').val()); // Convertir en nombre
        var quantite = parseInt($('#qte').val()); // Convertir en nombre
        var nbrebtle = parseInt($('#nbrebtle').val()); // Convertir en nombre

        // Vérifier si tous les champs sont remplis et différents de zéro
        if (boissonId === "" || 
            isNaN(prix) || prix <= 0 || 
            isNaN(quantite) || quantite <= 0 || 
            isNaN(nbrebtle) || nbrebtle <= 0) {
            alert("Veuillez remplir tous les champs avec des valeurs valides et supérieures à zéro.");
            return; // Bloquer l'exécution
        }

        // Calculer le montant de la ligne
        var montant = prix * quantite;

        // Ajouter le montant de la ligne au montant total
        montantTotal += montant;

        // Mettre à jour l'input #mtt avec le montant total suivi de ' FCFA'
        $('#mtt').val(montantTotal + ' FCFA');

        // Créer la nouvelle div
        var newDiv = `
            <div class="info-cmd">
                <div>
                    <span>Boisson</span>
                    <p>${boissonText}</p> <!-- Afficher le texte de l'option -->
                </div>
                <div class="red">
                    <span>Prix du casier/carton</span>
                    <p>${prix} FCFA</p>
                </div>
                <div>
                    <span>Nombre de casiers/cartons</span>
                    <p>${quantite}</p>
                </div>
                <div class="red">
                    <span>Montant</span>
                    <p>${montant} FCFA</p>
                </div>
            </div>
        `;

        // Ajouter la nouvelle div à #tab
        $('#tab').append(newDiv);

        // Ajouter la ligne au tableau des lignes
        lignes.push({
            boissonId: boissonId, // Envoyer la valeur (nombre)
            boissonText: boissonText, // Envoyer le texte de l'option
            prix: prix,
            quantite: quantite,
            nbrebtle: nbrebtle,
            montant: montant
        });

        // Mettre à jour le champ caché avec les données JSON
        $('#lignes').val(JSON.stringify(lignes));

        // Réinitialiser les champs
        $('#getName').val('');
        $('#prixa').val('');
        $('#qte').val('');
        $('#nbrebtle').val('');
    });

    // Intercepter la soumission du formulaire
    $('#commandeForm').submit(function(e) {
        // Ajouter dynamiquement les données au formulaire
        $('#commandeForm').append($('#lignes').clone());
    });
});