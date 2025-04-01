$(document).ready(function() {
	$('#choix').on('change', function() {
		var tri = $(this).val();

		if (tri != "") {
			document.location.href = "?tri="+tri;
		}
	});
});