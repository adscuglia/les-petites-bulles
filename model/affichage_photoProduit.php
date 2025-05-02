<?php
	require_once '../controller/bdd.php';
	require_once '../controller/authorisation.php';
	require_once '../controller/affichage_produit.php';

	if (isset($_GET['num'])) {
		$num = $_GET['num'];
		$photos = retournePhotoProduit($bdd, $num);
		echo '<input class="bu-sec" type="button" value="retour au produit">';
		if (!empty($photos)) {
			echo '<div class="grille">';
				foreach($photos as $photo) {
					echo '<button type="button" id="'.$photo['id_photo_produit'].'">';
					echo '<img src="../public/Image/produit/'.$photo['url'].'">';
					echo '</button>';
				}
			echo '</div>';
		}
		else {
			echo '<h2>Aucune photo enregistré</h2>';
		}
	}

?>