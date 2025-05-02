<?php
	require 'bdd.php';

	if(isset($_POST['submit'])) {
		$post = [
			'Date_atelier' => $_POST['Date_atelier'],
			'nb_participant_max' => $_POST['nombre'],
			'nom_atelier' => $_POST['nom_atelier'],
		];
		$newAtelier = new AtelierManager($bdd);
		$atelier = new Atelier();
		$atelier->hydrate($post);
		$newAtelier->add($atelier);
		$_SESSION['message'] = "l'atelier du ".anneeSQL($_POST['Date_atelier'])." est bien enregistré";
		header('Location: ../view/date_atelier.php');
	}
?>