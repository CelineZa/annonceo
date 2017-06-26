$(function(){
	//alert('ok');

	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('.modal-body input').val(recipient)
	});


	// Filtres page accueil
	$('#categorie').change(function(e){
/*		e.preventDefault();
		console.log($(this).val());

		$.ajax({
		  url: "http://localhost/annonceo/api.php", 
		  method: "GET",
		  data: {id_categorie : $(this).val()} 
		})	

		.done(function(dataForm){
			//$('#message_ajax').html("<div class='alert alert-success'><strong>Success !</strong> User deleted</div>");
			//$('#test').html(dataForm);
			console.log(dataForm);
			console.log(dataForm.titre);
		})

		.fail(function(jqXHR, textStatus) {
			$('#message_ajax').html("<div class='alert alert-danger'><strong>Error !</strong> User not deleted</div>");
		});*/
	});


	// Ajouter plus d'annonces en cliquant sur "Voir plus"
	increment = 0;

	$('.voir-plus a').click(function(e){
		e.preventDefault();
		//console.log('ok');
		/*var content = "";
		for(let i = increm ent; i < increment+10 ; i++)
		{

		}
		increment += 10;*/
	});

});