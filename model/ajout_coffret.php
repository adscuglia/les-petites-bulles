<?php
		require_once '../controller/bdd.php';
?>

<form action="../controller/ajout_coffret.php?ajout=coffret" method="post" enctype="multipart/form-data">
		<div class="formulaire">
			<label>Nom du coffret</label>
			<input type="text" name="nom" required>

			<label>Description du coffret</label>
			<input type="text" name="description" required>

			<label>Prix</label>
			<input type="number" name="prix" required>

			<label>Photo coffret</label>
			<input type="file" name="img">

			<input class="ajoutProduit" type="button" value="Ajouter un produit"><br>

			<div class="produits">

			</div>

			<input type="submit" name="submit">
			<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">

		</div>
	</form>