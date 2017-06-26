<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");
?>

<!-- Colonne du formulaire -->
<div class="col-md-4" id="accueil-form">
	<form action="" method="post">
		<div class="form-group">
			<label for="categorie">Catégorie</label>
			<select class="form-control">
				<option>Toutes les catégories</option>
				<?php
				$reqCategorie = $bdd->query("SELECT DISTINCT titre FROM categorie");
				while($categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC))
				{
					echo '<option value="'. $categorie['titre'] .'">'. $categorie['titre'] .'</option>';
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="categorie">Ville</label>
			<select class="form-control">
			  <option>Toutes les villes</option>
				<?php
				$reqAnnonce = $bdd->query("SELECT DISTINCT ville FROM annonce");
				while($annonce = $reqAnnonce->fetch(PDO::FETCH_ASSOC))
				{
					echo '<option value="'. $annonce['ville'] .'">'. $annonce['ville'] .'</option>';
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="membre">Membre</label>
			<select class="form-control">
			  <option>Tous les membres</option>
				<?php
				$reqMembre = $bdd->query("SELECT pseudo FROM membre");
				while($membre = $reqMembre->fetch(PDO::FETCH_ASSOC))
				{
					echo '<option value="'. $membre['pseudo'] .'">'. $membre['pseudo'] .'</option>';
				}
				?>
			</select>
		</div>

		<button type="submit" class="btn btn-info">Rechercher</button>
	</form>
</div>

<!-- Colonne où sont affichés les articles -->
<div class="col-md-8">
<?php
	$req = "SELECT * FROM annonce LIMIT 0, 5";
	$r = $bdd->query($req);

	while($annonce = $r->fetch(PDO::FETCH_ASSOC))
	{
?>
	<div class="bloc_annonce">
		<div class="photo_annonce">
			<img src="<?php echo $annonce['photo']; ?>" alt="photo">
		</div>
		<div class="texte_annonce">
			<h3><?php echo $annonce['titre']; ?></h3>
			<p><?php echo $annonce['description']; ?></p>
		
			<p><span><?php echo $annonce['prix']; ?>€</span></p>

			<?php
			$reqMembre = $bdd->query("SELECT pseudo, moyenne_note FROM membre WHERE id_membre = '$annonce[membre_id]'");
			$membre = $reqMembre->fetch(PDO::FETCH_ASSOC);
			?>
			
			<p>Posté par : <?php echo $membre['pseudo']; ?> - <?php echo $membre['moyenne_note'];  ?> note(s)</p>

			<p><a href="fiche_annonce.php?id_annonce=<?php echo $annonce['id_annonce']; ?>">Consulter cette annonce</a></p>
		</div>
	</div>
<?php
	}
?>
	<div class="clearfix"></div>
</div>


<?php
require_once("inc/bas.inc.php");
?>