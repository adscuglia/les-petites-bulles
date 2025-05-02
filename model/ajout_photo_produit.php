<?php
		require '../controller/bdd.php';
		$manager = new ProduitManager($bdd);
		$produits = $manager->getAll();
?>

<form action="../controller/ajout_produit.php?ajout=photo" method="post" enctype="multipart/form-data">
	<!-- ajouter une photo -->
		<div class="formulaire">
			<label>Produit</label>
			<select class="select" name ="num_produit">
				<?php
					foreach($produits as $produit) {
						echo '<option value="'.$produit['n_produit'].'">'.$produit['nom_produit'].'</option>';
					}
				?>
			</select>
			<br><br>

			<label>Photo produit</label>
			<input type="file" name="img" required>

			<input type="submit" name="submit">
			<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">

		</div>
	</form>