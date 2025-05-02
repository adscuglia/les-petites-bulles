<?php
	require_once 'bdd.php';

	function retourneDate($bdd) {
		$atelier = new AtelierManager($bdd);
		return $atelier->getAll();
	}

	function supprimerAtelier($bdd, $num) {
		$atelier = new AtelierManager($bdd);
		$inscrire = new InscrireManager($bdd);
		$inscrire->deleteAtelier($num);
		$atelier->delete($num);
	}

	function nombreInscris($bdd, $num) {
		$atelier = new AtelierManager($bdd);
		$nbrInscris = $atelier->nbrInscris($num);
		return $nbrInscris ?? 0; 
	}


	if (isset($_GET['num'])) {
		$num = $_GET['num'];
		supprimerAtelier($bdd, $num);
	}

?>