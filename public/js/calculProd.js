$(document).ready(function() {
    // Initialiser les totaux pour les colonnes 2 et 3
    let totalCol2 = 0; // Total de la quantité
    let totalCol3 = 0; // Total du montant de vente

    // Parcourir chaque ligne du tableau (sauf l'en-tête)
    $('#vente tbody tr').each(function() {
        // Récupérer les valeurs des colonnes 2 et 3
        const col2 = parseFloat($(this).find('td:eq(1)').text().replace(/\s/g, '')) || 0; // Colonne 2 (quantité)
        const col3 = parseFloat($(this).find('td:eq(2)').text().replace(/\s/g, '')) || 0; // Colonne 3 (montant de vente)

        // Ajouter les valeurs aux totaux
        totalCol2 += col2;
        totalCol3 += col3;
    });

    // Ajouter les totaux dans le tfoot
    $('#vente tfoot').html(`
        <tr style="font-weight: bold;">
            <td style="background-color:var(--rouge);color:var(--blanc);">Total</td>
            <td>${totalCol2}</td>
            <td>${totalCol3.toLocaleString('fr-FR')} FCFA</td>
        </tr>
    `);
});