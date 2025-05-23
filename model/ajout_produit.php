<?php
	require_once '../controller/bdd.php';

	$categorie_produitManager = new Categorie_produitManager($bdd);
	$categories = $categorie_produitManager->getAllCategorie();
?>
	<form action="../controller/ajout_produit.php?ajout=produit" method="post" enctype="multipart/form-data">
	<!-- ajouter une photo -->
		<div class="formulaire">
				<label>Nom Produit</label>
				<input type="text" name="nom" autocomplete="off" required>

				<label>Descriptif du produit</label>
				<input type="text" name="descriptif" required>

				<label>Prix</label>
				<input type="nombre" name="prix" required>
				
				<label>Categorie</label>
				<select name="categorie" class="choix-categorie">
					<?php
						foreach($categories as $categorie) {
							echo '<option value="'.$categorie['id_categorie_produit'].'">'.ucfirst($categorie['nom_categorie_produit']).'</option>';
						}
					?>
				</select>

				<input type="submit" name="submit">
				<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">
		</div>
	</form>