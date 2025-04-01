$(document).ready(function() {
    $('#choix').on('change', function() {
        var choix = $(this).val();

        if (choix) {
            if (choix == "total") {
                window.location.reload();
            }
            
            $.ajax({
                type: 'POST',
                url: '../control/addChoix.php',
                data: {choix: choix},
                success:function(data){
                    $('#periode').html(data);
                }
            });
        }
    });
});