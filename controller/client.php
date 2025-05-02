<?php
	require_once 'bdd.php';

	function retourneClient($bdd) {
		$manager = new ClientManager($bdd);
		return $manager->getAll();
	}

	function supprimerClient($bdd, $num_client) {
		$client = new ClientManager($bdd);
		$inscrire = new InscrireManager($bdd);
		$inscrire->deleteIdClient($num_client);
		$client->delete($num_client);
	}

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		supprimerClient($bdd, $id);
	}
?>