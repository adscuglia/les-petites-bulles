<?php
	require_once '../controller/bdd.php';

	header('Content-Type: application/json');

    $manager = new ProduitManager($bdd);
    $produits = $manager->getAll();

    echo json_encode($produits);


?>