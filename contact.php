<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");
?>

<div class="row">

  	<div class="col-md-12">

  		<h2>Coordonnées</h2>
		<address>
		<strong>Siège social</strong><br>
		110 avenue des Champs Elysées<br>
		Suite 600<br>
		75008 Paris, France<br>
		<abbr title="Phone">T.:</abbr> (+33) 01 78 48 10 10
		</address>
		<address>
		<strong>Nous écrire</strong><br>
		<a href="mailto:#" class="mail">annonceo@info.com</a>
		</address>

		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.263902437655!2d2.297493915674855!3d48.87224547928879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fea1e1f163b%3A0xf5a0c8ac38043e65!2s110+Av.+des+Champs-%C3%89lys%C3%A9es%2C+75008+Paris-8E-Arrondissement!5e0!3m2!1sfr!2sfr!4v1498467628724" allowfullscreen></iframe>

	  	<h2>Formulaire de contact</h2>
	  	<form action="" method="POST" class="form-contact">
	  	<div class="form-group">
			<label for="e-mail">E-mail</label>
			<input type="email" id="e-mail" name="e-mail" class="form-control" placeholder="e-mail">
		</div>
		<div class="form-group">
			<label for="titre">Objet</label>
			<input type="text" id="objet" name="objet" class="form-control" placeholder="objet">
		</div>
		<div class="form-group">
			<label for="message">Votre message</label>
			<textarea type="text" id="message" name="message" class="form-control" rows="7">Votre message</textarea>
		</div>
		<button type="submit" class="btn btn-primary">Envoyer</button>
		</form>
 	</div>

</div>


<?php
require_once("inc/bas.inc.php");
?>