
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

//---------------------- Intégrer un commentaire et notes ---------------------------//

if (isset($_POST['contact_notes']))
	{
			foreach ($_POST as $indice => $valeurs)
				{
			$_POST[$indice] = strip_tags($valeurs);
			$_POST[$indice] = htmlentities($valeurs);
			$_POST[$indice] = addslashes($valeurs);
			$_POST[$indice] = htmlentities($valeurs);
			$_POST[$indice] = htmlspecialchars($valeurs);
				}

		$req = "REPLACE INTO note (id_note, membre_id1, membre_id2,note,commentaire) VALUES(:id_note,:membre_id1,:membre_id2,:note,:commentaire)";

		$r = $bdd->prepare($req);

		$r->bindParam(':contact',$_POST['contact'],PDO::PARAM_INT);
		$r->bindParam('avis',$_POST['commentaire'], PDO::PARAM_STR);
		$r->bindParam(':id_note',$_POST['id_note'],PDO::PARAM_INT);
		//$r->bindParam(':membre_id',$_POST['membre_id'],PDO::PARAM_INT);
		//$r->bindParam('membre_id2',$_POST['membre_id2'], PDO::PARAM_STR);
		
		echo $r;
		//$r->execute();
	}



/****************FORMULAIRE MODAL Contact ******************/

if (isset($_POST['envoi_contact']))
{
/*	foreach ($_POST as $indice => $valeurs)
	{
		$_POST[$indice] = strip_tags($valeurs);
		$_POST[$indice] = htmlentities($valeurs);
		$_POST[$indice] = addslashes($valeurs);
		$_POST[$indice] = htmlentities($valeurs);
		$_POST[$indice] = htmlspecialchars($valeurs);
	}

	if(empty($content))
	{

		$req = "REPLACE INTO membre (id_membre,pseudo,nom,prenom,telephone,email,civilite,statut) VALUES(:id_membre,:pseudo,:nom,:prenom,:telephone,:email,:civilite,:statut)";

		$r = $bdd->prepare($req);

		$r->bindParam(':id_membre',$_POST['id_membre'],PDO::PARAM_STR);
		$r->bindParam(':pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$r->bindParam('nom',$_POST['nom'], PDO::PARAM_STR);
		$r->bindParam('prenom',$_POST['prenom'], PDO::PARAM_STR);
		$r->bindParam('telephone',$_POST['telephone'], PDO::PARAM_INT);
		$r->bindParam('email', $_POST['email'], PDO::PARAM_STR);
		$r->bindParam('civilite', $_POST['civilite'], PDO::PARAM_STR);
		$r->bindParam('statut', $_POST['statut'], PDO::PARAM_INT);

		$r->execute();

		$content .= '<div class="alert alert-success">Le membre a été intégré avec succès !</div>';

	}*/

	$_POST['expediteur'] = "From: $_POST[expediteur] \r\n"; //Permet d'intégrer du HTML + rentrer le nom de l'expéditeur.
	$_POST['expediteur'] = "Reply-To: $_POST[expediteur] \r\n"; 
	$_POST['expediteur'] .= "MIME-Version: 1.0 \r\n"; //MIME version est un standard d'envoi de mail, il permet d'intégrer à la fois du texte mais aussi des images, videos, sons, etc...
	$_POST['expediteur'] .= "Content-type: text/html; charset=iso-8859-1 \r\n"; //cette ligne permet d'envoyer du html directement dans le champ message, le script sera alors traduit. Pratique pour un envoi de newsletter
//		

	$_POST['message'] = "\r\n Nom: " . $_POST['expediteur']. "\r\n E-mail: " .$_POST['mail']. "\r\n E-mail: " . $_POST['tel']. "\r\n Message: " . $_POST['message']; // nous mettons toutes les informations dans le message sans oublier le message en question.
	
	mail('gdruet@gmail.com',$_POST['sujet'],$_POST['message'],$_POST['expediteur']);

// la fonction mail ()reçoit toujours 4 ARGUMENTS et l'ordre à une importance cruciale. Comme dans la plupart des fonctions, il faut repsecter le NOMBRE ET L'ORDRE des arguments que l'on transmet.php
//http://www.lacroix-test.esy.es/formulaire7_contact.php
}






//---------AFFICHAGE DES COMMENTAIRES PRECEDENTS : -------

$comments = $bdd->query("SELECT commentaire FROM commentaire WHERE annonce_id = '$_GET[id_annonce]'");
		$content .= "<h1>  Affichage des " . $comments->rowCount() . " commentaire(s)</h1>";
		$content .= "<table border='2' style='border-collapse:collapse;'><tr>";
		for($i = 0; $i < $comments->columnCount(); $i++)
			{
				$colonne = $comments->getColumnMeta($i);
				$content .= "<th>$colonne[name]</th>";
			}

			$content .= "</tr>";

		while ($ligne = $comments->fetch(PDO::FETCH_ASSOC))
			{
		$content .= '<tr>';

		foreach($ligne as $indice => $valeur)
			{

			$content .= "<td>$valeur</td>";
			}

	$content .= '</tr>';
	}
	$content .= '</table>';

//---------AFFICHAGE DES PRODUITS EQUIVALENTS : -------
/*
$photos = $bdd->query("SELECT photo FROM annonce WHERE annonce_id = '$_GET[id_annonce]'");
		$content .= "<h1>  Affichage des " . $photos->rowCount() . " commentaire(s)</h1>";
		$content .= "<table border='2' style='border-collapse:collapse;'><tr>";
		for($i = 0; $i < $photos->columnCount(); $i++)
			{
				$colonne = $photos->getColumnMeta($i);
				$content .= "<th>$colonne[name]</th>";
			}

			$content .= "</tr>";

		while ($ligne = $photos->fetch(PDO::FETCH_ASSOC))
			{
		$content .= '<tr>';

		foreach($ligne as $indice => $valeur)
			{

			$content .= "<td>$valeur</td>";
			}

	$content .= '</tr>';
	}
	$content .= '</table>';
*/








?>
<script type="text/javascript" src="js/app.js"> </script>

<div class="row" id="row">
  <div class="col-xs-6 col-md-6" id="titre_annonce"> <?php echo $annonce['titre'];?> </div>

<!-- lightbox de contact -->
  <div class="col-xs-6 col-md-6">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">  <?php echo "Contactez " .$contact['prenom'];?></button>

			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">

					      <div class="modal-header">
					         <h4 class="modal-title" id="exampleModalLabel">New message</h4>
					      </div><!-- fin de modal header-->

					      <div class="modal-body">
					        	<form action="#" method="post"> 
						         	 <div class="form-group">
							            <label for="recipient-name" class="control-label">Votre nom:</label>
							            <input type="text" name="expediteur" class="form-control" id="recipient-name">
						          	</div>
									<div class="form-group">
							           <label for="recipient-name" class="control-label">Votre e-mail:</label>
							            <input type="text" name="mail" class="form-control" id="recipient-name">
						          	</div>
								  	<div class="form-group">
							           <label for="recipient-name" name ="tel" class="control-label">Votre téléphone(non obligatoire):</label>
							            <input type="text" class="form-control" id="recipient-name">
						          	</div>
									<div class="form-group">
						          	<label for="Sujet">SUJET</label>
									<input type="text" name="sujet" id="sujet" placeholder="Votre Sujet">
									</div>

						          	<div class="form-group">
							            <label for="message-text" class="control-label">Message:</label>
							            <textarea class="form-control" name ="message" id="message-text"></textarea>
						          	</div>

					        	
					      </div> <!-- fin de modal body -->

					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="submit" name="envoi_contact" class="btn btn-primary">Send message</button>

					      </div> 
					      </form>

				    </div> <!-- fin de modal content-->
				  </div><!-- fin de modal dialog-->
		 	</div><!-- fin de exampleModal-->
  	</div><!-- fin de col-xs-6 col-md-4-->
</div> <!-- fin de row-->

<div class="row" id="row">
  	 	 <div class="col-xs-12 col-md-6"> <img src="<?php echo $annonce['photo'];?>" alt="photo" class="fiche_annonce_img"> </div>
		 <div class="col-xs-12 col-md-6"> <h2> <strong>Description </strong></h2> <?php echo $annonce['description'];?> </div>
</div>

<div class="row" id="row">
		 <div class="col-xs-3 col-md-3" id="barre_infos"> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo ' '.$annonce['date_enregistrement'];?> </div>

		 <div class="col-xs-3 col-md-3" id="barre_infos"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="membre/profil.php?prenom=<?php echo $contact['prenom']?>"><?php echo $contact['moyenne_note'] ;?>"</a></div>

		 <div class="col-xs-3 col-md-3" id="barre_infos"> <span class="glyphicon glyphicon glyphicon-euro" aria-hidden="true"> </span> <?php echo  $annonce['prix'] . " €";?></div>

		 <div class="col-xs-3 col-md-3" id="barre_infos"> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span> <?php echo "Adresse: " . $annonce['adresse'] . ', ' . $annonce['cp'] . ', ' . $annonce['ville'] ;?></div>

</div>

<div class="row" id="row" id="row">  
		<div class="col-xs-12 col-md-12" id="gmap">
			<iframe class="gmap" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?key=AIzaSyA8tBNdeGlYRSQKy0-YJsiPmNgYgfb9cnQ&q=<?php echo  $annonce['adresse'];?> <?php echo $annonce['ville'] ;?>" allowfullscreen>	</iframe>
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
	<hr>
  	<div class="col-xs-4 col-md-4">
<!-- lightbox de commentaires et notations -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" >Déposer un commentaire ou une note</button>
			<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			 	<div class="modal-dialog" role="document">
			    	<div class="modal-content">

					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="title" id="exampleModalLabel2">Veuillez laisser un avis et noter le vendeur</h4>
					      </div>

					      <div class="modal-body">
					        <form action="#" method="post"> 
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Contact:</label>
					            <input type="text" name="contact" class="form-control" id="recipient-name">
					          </div>
					          <div class="form-group">
					            <label for="message-text" class="control-label">Commentaire(s):</label>
					            <textarea class="form-control" name="avis" id="message-text"></textarea>
					          </div>

					          <div class="form-group">
					          <label for="notes-stars" class="control-label">Note:</label>
					          <div id='A1' class="form-control" name="id_note"><script type='text/javascript'>CreateListeEtoile('A1',5);</script> 
					          </div>

					          </div>
					        
					      </div>


						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="submit" name="contact_notes" class="btn btn-primary">Send message</button>
						      </div>
					      </form>

			    	</div> <!-- fin de modal content-->
			  	</div><!-- fin de modal-dialog-->
			</div><!-- fin de modalfade-->
			    
	</div><!-- fin col-xs-6 col-md-4-->

  <div class="col-xs-8 col-md-8 .col-md-offset-8" id="liens_annonces"><a href="index.php">Retour vers les annonces</a></div>
</div> <!-- fin de row-->
<hr>

<div class="row" id="row">
	<div class="col-xs-12 col-md-12">
	<h2><strong>Commentaires précédents</strong></h2>
	<?php echo $content; ?>
	</div>
</div>


</div>


<?php
require_once("inc/bas.inc.php");
?>
