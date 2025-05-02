<?php
	require 'bdd.php';


	if(isset($_POST['submit']) && $_GET['ajout'] === "produit") {
		$post = [
			'Nom_produit' => $_POST['nom'],
			'descriptif_produit' => $_POST['descriptif'],
			'prix_TTC' => $_POST['prix'],
		];
		$produit = new ProduitManager($bdd);
		$newProduit = new Produit();
		$newProduit->hydrate($post);
		$produit->add($newProduit);

		$_SESSION['dernier_choix'] = 'produit';
		$_SESSION['message'] = 'Le produit est bien enregistré';

		header('Location: ../view/ajout.php?page=nouveau');
		exit;
	}

	if (isset($_POST['submit']) && $_GET['ajout'] === "photo") {
		$message = '';
		$dir = '../public/Image/produit/';

		$nomFichier = basename($_FILES['img']['name']);
		$cheminComplet = $dir.$nomFichier;

		if(move_uploaded_file($_FILES['img']['tmp_name'], $cheminComplet)) {
			$photoManager = new Photo_produitManager($bdd);
			$photo = new Photo_produit();
			$post = [
				'url' => $nomFichier,
				'n_produit' => $_POST['num_produit']
			];
			$photo->hydrate($post);
			$photoManager->add($photo);
			$message = 'La photo a bien ete enregistré';
		}
		else {
			$message = 'erreur lors du chargement de l\'image';
		}

		$_SESSION['message'] = $message;
		header('Location: ../view/ajout.php?page=produit');
		exit;
	}

?>