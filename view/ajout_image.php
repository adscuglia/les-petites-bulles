<!DOCTYPE html>
<html lang="FR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image</title>
	<link rel="stylesheet" href="../public/style/formulaire.css">
</head>
<body>
	<header>
		<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
	</header>

	<!-- enctype pour envoyer le fichier au serveur et el stocker temporairement -->
	<form action="../controller/ajout_image.php" method="post" enctype="multipart/form-data">
		<div class="formulaire">
			<input type="file" name="img" required>
			<div>
				<label>Date de l'atelier</label>
				<?php
					if (!empty($_GET['photo'])) {
						echo '<input type="date" name="Date" value="0001-01-01" required>';
					}
					else {
						echo '<input type="date" name="Date"  required>';
					}
				?>
				<label>Description</label>
				<input type="text" name="description" autocomplete="off" required>

				<input type="submit" name="submit"><br>
				<input type="button" onclick="window.location.href = 'ajout_image.php?photo=affiche'" value="ajouter une affiche">
				<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">
			</div>
		</div><br>
		<?php
		    if(isset($_GET['msg'])) {
		        echo '<div class="formulaire">';
		            echo $_GET['msg'];
		        echo '</div>';
		    }
		?>
	</form>
</body>
</html>