<?php
	require 'bdd.php';

	if(isset($_POST['submit'])) {
		$message = '';
		$dir = '../public/Image/tissus/';
			// basename retourne seulement le nom sans le chemin d'acces 
		$nomFichier = basename($_FILES['img']['name']);
		$cheminComplet = $dir.$nomFichier;

		
		if (move_uploaded_file($_FILES['img']['tmp_name'], $cheminComplet)) {
			$tissusManager = new TissusManager($bdd);
			$tissus = new Tissus($bdd);
			$post = [
				'nom_tissus' => $_POST['nom'],
				'url_tissus' => $nomFichier,
				'ID_matiere' => $_POST['matiere'],
				'id_categorie' => $_POST['categorie']
			];
			$tissus->hydrate($post);
			$tissusManager->add($tissus);
			$message = "le tissu est enregistré";
		}
		else {
			$message = 'erreur lors du chargement de l\'image';
		}
	}
	header('Location: ../view/ajout.php?page=tissus');
?>