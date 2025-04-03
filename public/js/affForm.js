$(document).ready(function() {
    $("#btnPoste").click(function() {
      $("#mdfPoste").toggle();
    });

    // Afficher lieu de travail
    $('#poste').on('change', function() {
        var poste = $('#poste').val();
        if ((poste == 3) || (poste == 4)) {
            $("#serviceDiv").show();
            $("#service").prop('required', true);
        } else {
            $("#serviceDiv").hide();
            $("#service").prop('required', false);
        }
    });

    $("#btnIdentf").click(function() {
        $("#mdfIdentf").toggle();
    });

    $("#btnPass").click(function() {
        $("#mdfPass").toggle();
    });

    $("#btnDpse").click(function() {
        $("#mdfDpse").toggle();
    });

    $("#btnReg").click(function() {
        $("#mdfReg").toggle();
    });

    $("#btnPrix").click(function() {
        $("#mdfPrix").toggle();

        var kit = $('#kit').val();

        if (kit == 'yes') {
            $("#prixkit").show();
            $("#prixk").prop('required', true);

            $("#btekit").show();
            $("#nbrekit").prop('required', true);
        } else {
            $("#prixkit").hide();
            $("#prixk").prop('required', false);

            $("#btekit").hide();
            $("#nbrekit").prop('required', false);
        }
    });
});
