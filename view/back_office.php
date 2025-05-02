<?php
	require_once '../controller/authorisation.php'; // Protection obligatoire
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../public/style/formulaire.css">
	<title>Reservation</title>
</head>
<body>
	<header>
		<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
	</header>

	<main>
		<div class="formulaire align back">
			<button class="boutton" onclick="window.location.href = 'date_atelier.php'">Nouvelle date atelier</button>
			<button class="boutton" onclick="window.location.href = 'ajout_image.php'">Nouvelle photo d'atelier</button>
			<button class="boutton" onclick="window.location.href = 'info.php'">Voir les données</button>
			<button class="boutton" onclick="window.location.href = './ajout.php?page=tissus'">Ajout tissus</button>
			<button class="boutton" onclick="window.location.href = './ajout.php?page=produit'">Ajout Produit</button>
			<button class="boutton" onclick="window.location.href = './ajout.php?page=coffret'">Ajout coffret</button>
		</div>
	</main>
</body>
</html>