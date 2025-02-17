$(document).ready(function() {
    $('#addForm').submit(function(event) {
      var password1 = $('#pass').val();
      var password2 = $('#confpass').val();
      
      if (password1 != password2) {
        alert('Les mots de passe ne correspondent pas. Veuillez réessayer svp !');
        event.preventDefault(); // empêche l'envoi du formulaire si les mots de passe ne correspondent pas
      }
    });
  });