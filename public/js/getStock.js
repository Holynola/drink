$(document).ready(function() {
	$('#triStk').on('click', function() {
		$.ajax({
			url: '../control/addStock.php',
			beforeSend:function(){
				$('#stock').html("<span>Chargement en cours...</span>");
			},
			success:function(data){
				$('#stock').html(data);
			}
		});
	});
});