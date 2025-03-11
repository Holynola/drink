$(document).ready(function() {
    // Initialiser un tableau pour stocker les totaux de chaque colonne
    var totals = [0, 0, 0, 0]; // Index 0: Quantité, 1: Montant de vente, 2: Montant d'achat, 3: Bénéfice

    // Parcourir chaque ligne du tbody
    $('#benef tbody tr').each(function() {
        // Parcourir chaque cellule de la ligne (en ignorant la première colonne)
        $(this).find('td').each(function(index) {
            if (index > 0) { // Ignorer la première colonne (index 0)
                var value;
                if (index === 1) { // La deuxième colonne (Quantité) est un nombre simple
                    value = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                } else { // Les autres colonnes (Montant de vente, Montant d'achat, Bénéfice) ont le suffixe "FCFA"
                    value = parseFloat($(this).text().replace(/[^0-9.-]+/g, ""));
                }
                if (!isNaN(value)) {
                    totals[index - 1] += value; // Ajouter la valeur au total correspondant
                }
            }
        });
    });

    // Créer une nouvelle ligne pour le tfoot
    var tfootRow = '<tr><td style="background-color:var(--rouge);color:var(--blanc);font-weight:bold;">Total</td>';

    // Ajouter les totaux dans les cellules de la ligne
    for (var i = 0; i < totals.length; i++) {
        if (i === 0) { // La deuxième colonne (Quantité) est un nombre simple
            tfootRow += '<td style="font-weight:bold;">' + totals[i].toLocaleString() + '</td>';
        } else { // Les autres colonnes (Montant de vente, Montant d'achat, Bénéfice) ont le suffixe "FCFA"
            tfootRow += '<td style="font-weight:bold;">' + totals[i].toLocaleString() + ' FCFA</td>';
        }
    }

    tfootRow += '</tr>';

    // Ajouter la ligne au tfoot
    $('#benef tfoot').html(tfootRow);
});