<?php
	require 'bdd.php';

	header('Content-Type: application/json');

	$coffretManager = new CoffretManager($bdd);
	$produitManager = new ProduitManager($bdd);
	$coffrets = $coffretManager->getAll();
	$produits = $produitManager->getAll();

	echo json_encode([
		'coffrets' => $coffrets,
		'produits' => $produits,
	]);
?>