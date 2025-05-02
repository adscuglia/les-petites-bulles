<?php
	require_once '../controller/authorisation.php'; // Protection obligatoire
	$message = '';
	if (isset($_SESSION['message'])) {
		$message = $_SESSION['message'];
		unset($_SESSION['message']); // on le supprime pour ne pas le réafficher à chaque reload
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../public/style/formulaire.css">
	<script></script>
	<title>Reservation</title>
</head>
<body>
	<header>
		<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
	</header>

	<main>
		<div class="formulaire">
			<form action="../controller/ajout_date_atelier.php" method="post">
				<label for="Date_atelier">Date de l'atelier</label>
				<input type=date id="Date_atelier" name="Date_atelier">
				<br>
		
				<label for="nombre">Nombre max de participant</label>
				<input type=number id="nombre" name="nombre">
				<br>

				<label for="nom_atelier">nom de l'atelier</label>
				<input type="text" id="nom_atelier" name="nom_atelier">
				<br>

				<input name="submit" type="submit" value="Enregistrer">
			</form>
			<input type="button" onclick="window.location.href = './back_office.php'" value="Retour au back_office">

		</div>

		<?php
			if(!empty($message)) {
				echo '<div class="message"><p>'.$message.'</p></div>';
			}
		?>
	</main>
</body>
</html>