<?php
	require_once '../controller/bdd.php';
	require_once '../controller/affichage_tissus.php';
	require_once '../controller/authorisation.php';

	$tissus = retourneTissus($bdd);
	$categories = retourneCategorie($bdd);
?>
<main>
	<form action="../controller/ajout_tissus.php" method="post" enctype="multipart/form-data">
		<div class="formulaire">
			<input type="file" name="img" required>
			<div>
				<label>Nom tissus</label>
				<input type="text" name="nom"  required>

				<label>Categorie</label>
				<select class="choix-tissus">
					<?php
						foreach($categories as $categorie) {
							echo '<option value="'.$categorie['id_categorie'].'">'.ucfirst($categorie['nom_categorie']).'</option>';
						}
					?>
				</select>

				<label>Matiere</label>
				<select name ="matiere">
					<option value="2">coton</option>
				</select><br><br>

				<input type="submit" name="submit">
				<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">

			</div>
		</div>
	</form>

<div class="grille">
	<?php 
		foreach($tissus as $tissu) {
			echo '<button type="button" id="'.$tissu['n_tissus'].'" data-nom="'.$tissu['nom_tissus'].'">';
			echo '<img src="../public/Image/tissus/'.$tissu['url_tissus'].'" alt="'. $tissu['nom_tissus'].'">';
			echo '</button>';
		}
	?>
</div>
</main>