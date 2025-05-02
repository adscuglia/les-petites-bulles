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
		<div class="formulaire align">
			<?php
				if(!empty($_GET['message']) && $_GET['message'] === "reservation") {
					echo '<h1>Merci beaucoup pour votre inscription ! 🎉</h1>';
					echo "<p>Vous retrouverez le récapitulatif complet dans votre boîte mail. À très bientôt !</p>";
					echo '<button class="boutton" onclick="window.location.href = \'../view/atelier.php\'">retour aux ateliers</button>';
				}
				else if (!empty($_GET['message']) && $_GET['message'] === "contact") {
					echo '<h2>Merci pour votre message. 📩</h2>';
					echo '<p>Notre équipe reviendra vers vous dans les plus brefs délais pour répondre à votre demande.<br><br>Vous retrouverez également un récapitulatif dans votre boîte mail.</p>';
					echo '<button class="boutton" onclick="window.location.href = \'../index.php\'">retour a l\'accueil</button>';
				}
			?>
		</div>
	</main>
	
</body>
</html>