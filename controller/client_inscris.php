<?php
	require_once 'bdd.php';

	function retourneClient($bdd, $num) {
		$atelier = new AtelierManager($bdd);
		return $atelier->clientInscrisNumAtelier($num);
	}

	function supprimerInscription ($bdd, $n_atelier, $id) {
		$inscrire = new InscrireManager($bdd);
		$inscrire->delete($n_atelier, $id);
	}

	if(isset($_GET['id'])) {
		echo 'test';
		$id = $_GET['id'];
		$n_atelier = $_GET['num'];
		supprimerInscription ($bdd, $n_atelier, $id);
	}
?>