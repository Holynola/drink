$(document).ready(function() {
    // 1. Récupération des variables
    var sumRec = parseFloat($("#data-container").data("sum-rec"));
    var sumDp = parseFloat($("#data-container").data("sum-dp"));

    // 2. Calcul du montant initial (#mtt)
    var mtt = sumRec - sumDp;
    $("#mtt").val(formatFCFA(mtt));

    // 3. Gestion dynamique de #mtv
    $("#mtv").on("change", function() {
        var mtvNumber = parseFCFA($(this).val());
        var mttNumber = parseFCFA($("#mtt").val());
        var mank = Math.max(mttNumber - mtvNumber, 0);
        
        $("#mank").val(formatFCFA(mank));
    });

    // Fonctions utilitaires
    function formatFCFA(number) {
        return new Intl.NumberFormat('fr-FR').format(number) + " FCFA";
    }
    function cleanNumber(str) {
        return parseFloat(str.toString().replace(/[^\d,.-]/g, '').replace(',', '.')) || 0;
    }
    function parseFCFA(str) {
        return cleanNumber(str);
    }
});