	<?php
		require ('bdd.php');
		if (isset($_POST['submit'])) {
			$imgDone = false;
	
			$statusMsg = "";
			$dir = '../public/Image/atelier/';
	
			$ateliers = new AtelierManager($bdd);
			$n_atelier = $ateliers->getN_atelierAvecDate($_POST['Date']);
			if (!empty($_FILES['img']['name'])) {
	
				$typeAutorise = ['jpg','png', 'jpeg', 'gif', 'pdf'];
	
				$nomFichier = basename($_FILES['img']['name']);
					//chemin complet de destination 
				$chemin = $dir.$nomFichier;
					// recupere l'extension du fichier 
				$type = pathinfo($chemin, PATHINFO_EXTENSION);
	
					// pas tester a partir de la 
				if (in_array($type, $typeAutorise)) {
					if(move_uploaded_file($_FILES['img']['tmp_name'], $chemin)) {
						$req = $bdd->prepare('INSERT INTO photos_atelier(url, n_atelier, description) VALUES (?, ?, ? )');
						$req->execute([$nomFichier,  $n_atelier, $_POST['description']]);
						if ($req) {
							$statusMsg = "Le fichier a bien ete chargé";
							$imgDone = true;
						}
						else {
							$statusMsg = "Le fichier n'a pas ete enregistré";
						}
					}
					else {
						$statusMsg = "erreur lors du chargemen du fichier";
					}
				}
				else {
					$statusMsg = "type non autorisés !";
				}
			}
			else {
				$statusMsg = "Selectionner un fichier a chager";
			}
		}
?>

</body>
</html>