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

<div class="row">
  <div class="col-xs-6 col-md-4"> <?php echo $annonce['titre'];?> </div>

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
			            <label for="recipient-name" class="control-label">Recipient:</label>
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
  <div class="row">
    
 <div class="row">
  <div class="col-xs-12 col-md-6"> <img src="<?php echo $annonce['photo'];?>" alt="photo"> </div>
  <div class="col-xs-12 col-md-6"> <?php echo $annonce['description'];?> </div>

</div>

<div class="row">
  <div class="col-xs-4 col-md-4"> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo  " " .  $annonce['date_enregistrement'];?> </div>

  <div class="col-xs-4 col-md-4"><span class="glyphicon glyphicon-user" aria-hidden="true"> <a href="membre/profil.php?prenom=<?php echo $contact['prenom']?>"><?php echo " " . $contact['moyenne_note'] ;?>"</a></div>

  <div class="col-xs-4 col-md-4"><span class="glyphicon glyphicon glyphicon-euro" aria-hidden="true"><?php echo  " " .  $annonce['prix'];?></div>
  
  <div class="col-xs-4 col-md-4">icone point gmap + Adresse</div>
</div>

<div class="row">
	<div class="col-xs-12 col-md-12">
	</div>
</div>

<div class="row">
<h2>Autres annonces</h2>
  <div class="col-xs-6 col-md-4">Photo autre annonce</div>
  <div class="col-xs-6 col-md-4">Photo autre annonce</div>
  <div class="col-xs-6 col-md-4">Photo autre annonce</div>
  <div class="col-xs-6 col-md-4">Photo autre annonce</div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-4">Lien déposer un commentaire ou une note</div>
  <div class="col-xs-6 col-md-4 .col-md-offset-4">Lien retour vers les annonces</div>
</div>


<?php
require_once("inc/bas.inc.php");
?>
