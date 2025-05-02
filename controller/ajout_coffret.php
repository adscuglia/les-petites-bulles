<?php
	require 'bdd.php';

	if (isset($_POST['submit']) && $_GET['ajout'] === "coffret") {
			$message = '';
			$dir = '../public/Image/coffret/';

			$nomFichier = basename($_FILES['img']['name']);
			$cheminComplet = $dir.$nomFichier;

		
			if(move_uploaded_file($_FILES['img']['tmp_name'], $cheminComplet)) {
				$coffretManager = new CoffretManager($bdd);
				$coffret = new Coffret();
				$post = [
					'nom_coffret' => $_POST['nom'],
					'description_coffret' => $_POST['description'],
					'prix_ttc' => $_POST['prix'],
					'photo_coffret' => $nomFichier,
				];
				$coffret->hydrate($post);
				$id_coffret = $coffretManager->add($coffret);

				$integrer = new Integrer();
				$integrerManager = new IntegrerManager($bdd);
				if (!empty($_POST['produits'])) {
					foreach($_POST['produits'] as $produit) {
						$post2 = [
							'N_produit' => $produit,
							'id_coffret' => $id_coffret,
						];
						$integrer->hydrate($post2);
						$integrerManager->add($integrer);
					}
				}


				$message = 'La coffret a bien ete enregistré';
			}
			else {
				$message = 'erreur lors du chargement de l\'image';
			}

			$_SESSION['message'] = $message;
			header('Location: ../view/ajout.php?page=coffret');
			exit;
		}

?>