$(document).ready(function() {
    // Afficher les informations du kit
    $('#kit').on('change', function() {
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