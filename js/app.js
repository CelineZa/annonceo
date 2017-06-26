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

/*********ON CLICK MODAL - CONTACT****************************/


$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})


/*********ON CLICK MODAL2 - COMMENTAIRES ET NOTES****************************/

$('#exampleModal2').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})


/************NOTATIONS ETOILES *************************/

// Tableau de memorisation des notes pour chaque liste
var ArrListeEtoile = new Object();

//-------------------------------------------------------
// Gestion de la visibilite des etoiles au survol
//-------------------------------------------------------
function GestionHover(idListe, indice, nbEtoile){
	for (i=1; i<= nbEtoile; i++)
	{
		var idoff = "staroff-" + idListe + "-" + i;
		var idon = "staron-" + idListe + "-" + i;
		
		if(indice == -1)
		{
			// Sortie du survol de la liste des etoiles
			if (ArrListeEtoile[idListe] >= i){
				document.getElementById(idoff).style.display ="none";
				document.getElementById(idon).style.display ="block";
			}
			else{
				document.getElementById(idoff).style.display ="block";
				document.getElementById(idon).style.display ="none";
			}
		}
		else
		{
			// Survol de la liste des etoiles
			if(i <= indice){
				document.getElementById(idoff).style.display ="none";
				document.getElementById(idon).style.display ="block";
			}
			else{
				document.getElementById(idoff).style.display ="block";
				document.getElementById(idon).style.display ="none";
			}
		}
	}
}

//-------------------------------------------------------
// Selection d une note pour une liste
//-------------------------------------------------------
function ChoixSelection(idListe, indice, nbEtoile){
	ArrListeEtoile[idListe] = indice;
	var score = "score-" + idListe;
	document.getElementById(score).innerHTML = " " + indice + "/" + nbEtoile;
}

//-------------------------------------------------------
// Creation d une liste de notation unique
//-------------------------------------------------------
function CreateListeEtoile(idListe, nbEtoile){
	ArrListeEtoile[idListe] = 0;

	var renduListe = "";
	renduListe += "<div class=\"listeEtoile\" onmouseout=\"GestionHover('" + idListe + "', -1, '" + nbEtoile + "')\">";
	renduListe += "<ul>";
	
	for(i=1; i<=nbEtoile; i++){
		renduListe += "<li>";
		renduListe += "<a href=\"javascript:ChoixSelection('" + idListe + "', '" + i + "', '" + nbEtoile + "')\" onmouseover=\"GestionHover('" + idListe + "', '" + i + "', '" + nbEtoile + "')\">";
		renduListe += "<img id=\"staroff-" + idListe + "-" + i + "\" src=\"image/staroff.gif\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: block;\">";
		renduListe += "<img id=\"staron-" + idListe + "-" + i + "\" src=\"image/staron.gif\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: none;\">";
		renduListe += "</a>";
		renduListe += "</li>";
	}
	
	renduListe += "	</ul>";
	renduListe += "</div>";
	renduListe += "<label id=\"score-" + idListe + "\"></label>";
	
	document.getElementById(idListe).outerHTML = renduListe;
}
