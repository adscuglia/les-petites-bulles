	<form action="../controller/ajout_produit.php?ajout=produit" method="post" enctype="multipart/form-data">
	<!-- ajouter une photo -->
		<div class="formulaire">
				<label>Nom Produit</label>
				<input type="text" name="nom" autocomplete="off" required>

				<label>Descriptif du produit</label>
				<input type="text" name="descriptif" required>

				<label>Prix</label>
				<input type="nombre" name="prix" required>

				<input type="submit" name="submit">
				<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">
		</div>
	</form>