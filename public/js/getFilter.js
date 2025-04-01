$(document).ready(function() {
    $('#choix').on('change', function() {
        var tri = $(this).val();

        if (tri == "total") {
            document.location.href = "?tri="+tri;
        }
    });
    
    $('#periode').on('change', function() {
        var periode = $(this).val();
        var choix = $('#choix').val();

        document.location.href = "?tri="+choix+"&condi="+periode;
    });
});