$(document).ready(function() {
    function formatFCFA(number) {
        return new Intl.NumberFormat('fr-FR', { style: 'decimal' }).format(number) + ' FCFA';
    }

    function parseFCFA(value) {
        return parseFloat(value.replace(/\s/g, '').replace('FCFA', ''));
    }

    function calculateDifference() {
        let mtt = parseFCFA($('#mtt').val());
        let mtr = parseFCFA($('#mtr').val());

        if (!isNaN(mtt) && !isNaN(mtr)) {
            let difference = mtt - mtr;
            $('#diff').val(formatFCFA(difference));
        } else {
            $('#diff').val('');
        }
    }

    // Déclencher le calcul lorsque #mtr change
    $('#mtr').on('change', function() {
        calculateDifference();
    });

    // Déclencher le calcul lorsque #diff change (si nécessaire)
    $('#diff').on('change', function() {
        calculateDifference();
    });

    // Exemple de valeur initiale pour le montant recette
    $('#mtt').val('0 FCFA');
});