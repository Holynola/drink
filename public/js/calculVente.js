$(document).ready(function() {
    // Tableau pour stocker les données des lignes
    let lignes = [];

    // Fonction pour mettre à jour le champ caché avec les données JSON
    function mettreAJourLignes() {
        // Réinitialiser le tableau des lignes
        lignes = [];

        // Parcourir chaque ligne du tableau, sauf la dernière (totaux)
        $('#tableVentes tbody tr').not(':last').each(function() {
            // Récupérer les données de la ligne
            var boissonId = $(this).find('td').eq(0).attr('class'); // ID de la boisson
            var boissonText = $(this).find('td').eq(0).text(); // Nom de la boisson
            var stockInitial = parseInt($(this).find('td').eq(1).text(), 10); // Stock initial
            var stockApresVente = parseInt($(this).find('input[name="stock[]"]').val(), 10); // Stock après vente
            var consignation = parseInt($(this).find('td').eq(3).text(), 10); // Consignation
            var produitsVendus = stockInitial - (stockApresVente - consignation); // Produits vendus
            var montant = parseFloat($(this).find('.montant').text().replace(/[^0-9]/g, '')); // Montant

            // Vérifier si une ligne pour cette boisson existe déjà
            var ligneExistante = lignes.find(function(ligne) {
                return ligne.boissonId === boissonId;
            });

            // Si la ligne existe, la mettre à jour
            if (ligneExistante) {
                ligneExistante.stockApresVente = stockApresVente;
                ligneExistante.produitsVendus = produitsVendus;
                ligneExistante.montant = montant;
                ligneExistante.consignation = consignation;
            } else {
                // Sinon, ajouter une nouvelle ligne
                lignes.push({
                    boissonId: boissonId,
                    boissonText: boissonText,
                    stockInitial: stockInitial,
                    stockApresVente: stockApresVente,
                    produitsVendus: produitsVendus,
                    montant: montant,
                    consignation: consignation
                });
            }
        });

        // Mettre à jour le champ caché avec les données JSON
        $('#lignes').val(JSON.stringify(lignes));
    }

    // Fonction pour calculer et mettre à jour les totaux
    function mettreAJourTotaux() {
        let totalStockInitial = 0;
        let totalStockApresVente = 0;
        let totalConsignation = 0;
        let totalProduitsVendus = 0;
        let totalMontant = 0;

        // Parcourir chaque ligne du tableau (sauf la ligne des totaux)
        $('#tableVentes tbody tr').not(':last').each(function() {
            totalStockInitial += parseInt($(this).find('td').eq(1).text(), 10) || 0;
            totalStockApresVente += parseInt($(this).find('input[name="stock[]"]').val(), 10) || 0;
            totalConsignation += parseInt($(this).find('td').eq(3).text(), 10) || 0;
            totalProduitsVendus += parseInt($(this).find('.produits-vendus').text(), 10) || 0;
            totalMontant += parseFloat($(this).find('.montant').text().replace(/[^0-9]/g, '')) || 0;
        });

        // Mettre à jour les cellules de totaux
        $('#tableVentes tbody tr:last td').eq(1).text(totalStockInitial);
        $('#tableVentes tbody tr:last td').eq(2).text(totalStockApresVente);
        $('#tableVentes tbody tr:last td').eq(3).text(totalConsignation);
        $('#tableVentes tbody tr:last td').eq(4).text(totalProduitsVendus);
        $('#tableVentes tbody tr:last td').eq(5).text(totalMontant.toLocaleString('fr-FR') + ' FCFA');

        // Mettre à jour l'élément <input> avec le total des montants
        $('#mtt').val(totalMontant.toLocaleString('fr-FR') + ' FCFA');
    }

    // Écouter les changements dans les champs de saisie du stock après vente
    $('input[name="stock[]"]').on('change', function() {
        // Récupérer la ligne parente (<tr>)
        var $row = $(this).closest('tr');
        
        // Récupérer le stock initial
        var stockInitial = parseInt($row.find('td').eq(1).text(), 10);
        
        // Récupérer le stock après vente saisi
        var stockApresVente = parseInt($(this).val(), 10);
        
        // Récupérer la consignation
        var consignation = parseInt($row.find('td').eq(3).text(), 10);
        
        // Calculer les produits vendus
        var produitsVendus = stockInitial - (stockApresVente - consignation);
        
        // Vérifier si produitsVendus est supérieur à stockInitial
        if (produitsVendus > stockInitial || produitsVendus < 0)  {
            // Afficher un message d'erreur
            alert("Erreur : Les produits vendus ne peuvent pas dépasser le stock initial ou être négatifs.");
            
            // Réinitialiser le champ stockApresVente
            $(this).val(stockInitial - consignation); // Réinitialiser à la valeur maximale possible
            
            // Recalculer produitsVendus avec la nouvelle valeur
            produitsVendus = stockInitial - (parseInt($(this).val(), 10) + consignation);
        }
        
        // Mettre à jour la cellule des produits vendus
        $row.find('.produits-vendus').text(produitsVendus);
        
        // Récupérer les prix et btekitB depuis les attributs data
        var prixVente = parseFloat($row.find('.prix').data('prixvb'));
        var prixKit = parseFloat($row.find('.prix').data('prixkitb'));
        var bteKit = parseFloat($row.find('.prix').data('btekitb'));
        
        // Calculer le montant
        var montant;
        if (prixKit && !isNaN(prixKit)) {
            // Si prixKit est disponible, calculer en fonction de bteKit
            var nombreKits = Math.floor(produitsVendus / bteKit); // Nombre de kits complets
            var produitsRestants = produitsVendus % bteKit; // Produits restants hors kits
            montant = (nombreKits * prixKit) + (produitsRestants * prixVente);
        } else {
            // Si prixKit n'est pas disponible, utiliser uniquement prixVente
            montant = produitsVendus * prixVente;
        }
        
        // Formater le montant avec des séparateurs de milliers
        var montantFormate = montant.toLocaleString('fr-FR');
        
        // Mettre à jour la cellule du montant (en FCFA, sans décimales)
        $row.find('.montant').text(montantFormate + ' FCFA');

        // Mettre à jour les données JSON dans le champ caché
        mettreAJourLignes();

        // Mettre à jour les totaux
        mettreAJourTotaux();
    });

    // Écouter la soumission du formulaire
    $('#venteForm').submit(function(e) {
        // Empêcher la soumission du formulaire pour vérification
        e.preventDefault();

        // Mettre à jour les données JSON avant de soumettre
        mettreAJourLignes();

        // Cloner le champ caché et l'ajouter au formulaire
        $('#venteForm').append($('#lignes').clone());

        // Afficher les données JSON dans la console pour vérification
        console.log(JSON.parse($('#lignes').val()));

        // Soumettre le formulaire
        this.submit();
    });

    // Initialiser les totaux au chargement de la page
    mettreAJourTotaux();
});