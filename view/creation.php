<?php
	$page = 'creations';
	$debutTitre = 'TOUT NOS ';
	$finTitre = 'PRODUITS';
	require_once 'layouts/header.php';
	require '../controller/bdd.php';
	$photoProduitManager = new photo_produitManager($bdd);
	$photos = $photoProduitManager->getDernierePhotoAllProduit();
	$produitManager = new ProduitManager($bdd);
?>

<main>

	<div class="grille">
	<?php 
		foreach($photos as $photo) {
			$produit = $produitManager->getProduitParNum($photo['n_produit']); 
			echo '<div class="carte" data-num="'.$photo['n_produit'].'">';
			echo '<div class="image">';
				echo '<img src="../public/Image/produit/'.$photo['url'].'" alt="'. $produit['nom_produit'].'">';
			echo '</div>';
			echo '<div class="contenu">';
				echo '<h4>'.$produit['nom_produit'].'</h4>';
				echo '<p>'.$produit['descriptif_produit'].'</p>';
			echo '</div>';
			echo '</div>';
		}
	?>
	</div>

</main>
<script src="../public/script/creation.js"></script>

<?php
	require_once 'layouts/footer.php';
?>
