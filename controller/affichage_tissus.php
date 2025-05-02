<?php
	require_once 'bdd.php';

	function retourneTissus($bdd) {
		$tissus = new TissusManager($bdd);
		return $tissus->getAll();
	}

	function retourneCategorie($bdd) {
		$categorie = new CategorieManager($bdd);
		return 	$categorie->getAll();
	}

	if (!empty($_GET['id']) && isset($_GET['id'])) {
		$id = $_GET['id'];
		$tissus = new TissusManager($bdd);
		$tissus->delete($id);
	}

	if (!empty($_GET['idSuppr']) && isset($_GET['idSuppr'])) {
		$id = $_GET['idSuppr'];
		$cat = new CategorieManager($bdd);
		$cat->delete($id);
	}

	if (isset($_POST['submit'])) {
		$manager = new CategorieManager($bdd);
		$categorie = new Categorie();
		$post = ['nom_categorie' => $_POST['nom']];
		$categorie->hydrate($post);
		$manager->add($categorie);
		header('Location: ../view/ajout.php?page=tissus');
		exit;
	}
?>