<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");



if(isset($_GET['id_annonce']))
{
	$resultat = $bdd->query("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");
}
$annonce = $resultat->fetch(PDO::FETCH_ASSOC);
//debug($annonce);
//debug($annonce['membre_id']);
$membre = $bdd->query("SELECT * FROM membre WHERE id_membre = '$annonce[membre_id]'");
$contact = $membre->fetch(PDO::FETCH_ASSOC);



/*
Annonce : categorie_id, photo, description, date enregistrement, prix, adresse, ville, cp, pays
membre_id
Membre : id_membre, prenom, moyenne_note

*/

?>

<div class="row" id="row">
  <div class="col-xs-6 col-md-4" id="titre_annonce"> <?php echo $annonce['titre'];?> </div>

<!-- lightbox de contact -->

  <div class="col-xs-6 col-md-4">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">  <?php echo "Contactez " .$contact['prenom'];?></button>

			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			         <h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      </div>
			      <div class="modal-body">
			        <form>
				          <div class="form-group">
					            <label for="recipient-name" class="control-label">Votre nom:</label>
					            <input type="text" class="form-control" id="recipient-name">
				          </div>
							<div class="form-group">
					           <label for="recipient-name" class="control-label">Votre e-mail:</label>
					            <input type="text" class="form-control" id="recipient-name">
				          </div>
								<div class="form-group">
					           <label for="recipient-name" class="control-label">Votre téléphone(non obligatoire):</label>
					            <input type="text" class="form-control" id="recipient-name">
				          </div>

				          <div class="form-group">
					            <label for="message-text" class="control-label">Message:</label>
					            <textarea class="form-control" id="message-text"></textarea>
				          </div>

			        </form>
			      </div> <!-- fin de modal body -->
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary">Send message</button>
			      </div>
			    </div>
			  </div>
	</div>	 	
  	</div>
</div> 

<div class="container">
  <div class="row" id="row">
    
 <div class="row">
  <div class="col-xs-12 col-md-6"> <img src="<?php echo $annonce['photo'];?>" alt="photo" class="fiche_annonce_img"> </div>
  <div class="col-xs-12 col-md-6"> <h2> <strong>Description </strong></h2> <?php echo $annonce['description'];?> </div>

</div>

<div class="row" id="row">
  	<div class="col-xs-4 col-md-4"> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo $annonce['date_enregistrement'];?> </div>

 	<div class="col-xs-4 col-md-4"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="membre/profil.php?prenom=<?php echo $contact['prenom']?>"><?php echo $contact['moyenne_note'] ;?>"</a></div>

 	<div class="col-xs-4 col-md-4"><span class="glyphicon glyphicon glyphicon-euro" aria-hidden="true"> </span> <?php echo  $annonce['prix'];?></div>
</div>

<div class="row" id="row" id="row">  
  	<div class="col-xs-12 col-md-12">
		<iframe 
		 width="100%"
  		height="200"

		 frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?key=AIzaSyA8tBNdeGlYRSQKy0-YJsiPmNgYgfb9cnQ&q=<?php echo  $annonce['adresse'];?> <?php echo $annonce['ville'] ;?>" allowfullscreen>
		</iframe>
	</div>
</div>


<div class="row" id="row">
	<h2><strong>Autres annonces</strong></h2>
	<hr>
	  <div class="col-xs-6 col-md-3">Photo autre annonce</div>
	  <div class="col-xs-6 col-md-3">Photo autre annonce</div>
	  <div class="col-xs-6 col-md-3">Photo autre annonce</div>
	  <div class="col-xs-6 col-md-3">Photo autre annonce</div>
</div>

<div class="row" id="row">

  	<div class="col-xs-6 col-md-4">Déposer un commentaire ou une note</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Déposer un commentaire ou une note</button>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			 	<div class="modal-dialog" role="document">
			    	<div class="modal-content">

					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
					      </div>

					      <div class="modal-body">
					        <form>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Recipient:</label>
					            <input type="text" class="form-control" id="recipient-name">
					          </div>
					          <div class="form-group">
					            <label for="message-text" class="control-label">Message:</label>
					            <textarea class="form-control" id="message-text"></textarea>
					          </div>
					        </form>
					      </div>

					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary">Send message</button>
					      </div>

			    	</div>
			  	</div>
			</div>
			    
	</div>

  <div class="col-xs-6 col-md-4 .col-md-offset-4">Lien retour vers les annonces</div>
</div>


<?php
require_once("inc/bas.inc.php");
?>
