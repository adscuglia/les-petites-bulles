<?php
	require_once 'bdd.php';

	function retourneProduit($bdd) {
		$produits = new ProduitManager($bdd);
		return $produits->getAll();
	}
	
	function retournePhotoProduit($bdd, $num) {
		$photo = new Photo_produitManager($bdd);
		return $photo->getPhotoAvecProduit($num);
	}

	if (isset($_GET['action']) && $_GET['action'] === "supprimer") {
		$num = $_GET['num'];
		$produits = new ProduitManager($bdd);
		$photo = new Photo_produitManager($bdd);
		$photo->deletePhotoProduit($num);
		$produits->delete($num);
	}

	if (isset($_GET['action']) && $_GET['action'] === "modifier") {
		$prix = $_GET['prix'];
		$num = $_GET['num'];
		$produits = new ProduitManager($bdd);
		$produits->updatePrix($prix, $num);
	}

	if (isset($_GET['action']) && $_GET['action'] === "photoSupprimer") {
		$num = $_GET['num'];
		$photo = new Photo_produitManager($bdd);
		$photo->delete($num);
	}

?>