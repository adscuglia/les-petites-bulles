<?php
	require 'config.php';
		// try catch pour montrer ou est l'erreur si il y en a une 
	try {
		$bdd = new PDO(
			'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
			DB_USER,
			DB_PASS,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		// le tableau pour les options des erreurs a toujours mettre pour retourner des erreurs comprehensible
	);
	}
	catch (Exception $e) {
		die('Erreur : '.$e->getMessage());
			// affiche le message d'erreur si il y en a une 
	}

	require __DIR__ . '/../model/atelierManager.php';
	require __DIR__ . '/../model/client.php';
	require __DIR__ . '/../model/inscrire.php';
	require __DIR__ . '/../model/photos_atelier.php';
	require __DIR__ . '/../model/matiereManager.php';
	require __DIR__ . '/../model/produitManager.php';
	require __DIR__ . '/../model/tissusManager.php';
	require __DIR__ . '/../model/photo_produitManager.php';
	require __DIR__ . '/../model/integrerManager.php';
	require __DIR__ . '/../model/coffretManager.php';
	require __DIR__ . '/../model/categorieManager.php';
	require __DIR__ . '/../model/categorie_produitManager.php';
	

    function anneeSQL($date) {
		$année = substr($date, 0, 4);
		$mois = substr($date, 5 , 2);
		$jour = substr($date, 8, 2);
		return $jour.'/'.$mois.'/'.$année;
	}

	function derniereAffiche($bdd) {
		$image = new PhotoManager($bdd);
		$affiche = $image->getDerniereAffiche();
		return $affiche;
	}

	function anneeAtelierPhoto($bdd) {
		$anneeValide = [];
		$atelier = new AtelierManager($bdd);
		$photoManager = new PhotoManager($bdd);
		$allAnnee = $atelier->getAllAnnees();
		foreach($allAnnee as $annee) {
			$anneeValue = $annee["YEAR(Date_atelier)"];
			$allNom = $atelier->getAllNomParAnnee($anneeValue);
			
			// Vérifie si l'année a des ateliers avec photos
			$hasPhotos = false;
			foreach($allNom as $nom) {
				$photos = $photoManager->getImageParNumero($nom['n_atelier']);
				if (!empty($photos)) {
					$hasPhotos = true;
					break;
				}
			}
			if ($hasPhotos) {
				$anneeValide[] = $annee["YEAR(Date_atelier)"];
			}
		}
		return $anneeValide;
	}

		function atelierParAnnee($bdd, $annee) {
			$allNom = [];
			$photoParAtelier = [];
			$atelier = new AtelierManager($bdd);
			$photoManager = new PhotoManager($bdd);
			
			// Récupérer tous les noms d'ateliers pour une année donnée
			$allNom = $atelier->getAllNomParAnnee($annee);
			$photoParAtelier = [];
		
			foreach($allNom as $nom) {
				// Récupérer les photos associées à chaque atelier
				$photos = $photoManager->getImageParNumero($nom['n_atelier']);
				if (!empty($photos)) {
					// Associer les photos à l'atelier et ajouter dans le tableau
					$photoParAtelier[] = [
						'nom_atelier' => $nom['nom_atelier'],
						'photos' => $photos
					];
				}
			}
			
			return $photoParAtelier;
		}

		// function afficheClient($bdd) {
		// 	echo '<p> </p>'
		// }

			// test add
	// $test = new InscrireManager($bdd);
	// $post = [
	// 	'ID_client' => 30,
	// 	'n_Atelier' => 9,
	// ];
	// $matiere = new Inscrire();
	// $matiere->hydrate($post);
	// $test->add($matiere);

			// test getAll
	// $recup = new ProduitManager($bdd);
	// $recupAll = $recup->getAll();
	// foreach($recupAll as $test) {
	// 	echo $test['n_tissus'];
	// }

			// test update
	// $test = new ProduitManager($bdd);
	// $post = [
	// 	'nom_produit' => 'attache tetine',
	// 	'descriptif_produit' => 'test',
	// 	'prix_TTC' => 35,
	// 	'n_tissus' => 1,
	// ];
	// $matiere = new Produit();
	// $matiere->hydrate($post);
	// $test->update($matiere, 1);


	// $test = new AtelierManager($bdd);
	// $affiche = $test->nbrInscris(10);
	// echo $affiche['total'];
?>