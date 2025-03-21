$(document).ready(function() {
    // Initialiser les totaux pour les colonnes 3 et 5
    let totalCol3 = 0;
    let totalCol5 = 0;

    // Parcourir chaque ligne du tableau (sauf l'en-tête et le pied de page)
    $('#stock tbody tr').each(function() {
        // Récupérer les valeurs des colonnes 3 et 5
        const col3 = parseFloat($(this).find('td:eq(2)').text()) || 0; // Colonne 3 (index 2)
        const col5 = parseFloat($(this).find('td:eq(4)').text()) || 0; // Colonne 5 (index 4)

        // Ajouter les valeurs aux totaux
        totalCol3 += col3;
        totalCol5 += col5;
    });

    // Afficher les totaux dans le pied de tableau (<tfoot>)
    $('#stock tfoot tr').html(`
        <td style="background-color:var(--rouge);color:var(--blanc);" colspan="2"><strong>Total</strong></td>
        <td style="color:var(--rouge);"><strong>${totalCol3}</strong></td>
        <td style="background-color:var(--gris);"></td>
        <td style="color:var(--bleu);"><strong>${totalCol5}</strong></td>
    `);
});