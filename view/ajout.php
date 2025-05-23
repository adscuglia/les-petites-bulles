<?php
	require_once '../controller/authorisation.php'; // Protection obligatoire
	$message = '';

?>

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
			<a  href="../index.php"><img style="width: 100px; margin-bottom: -50px;" src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
		</header>

		<?php
			if ($_GET['page'] === "produit" || $_GET['page'] === "nouveau") {
				echo '<div class="align">';
        			echo '<select class="choix" name="choix">';
            			echo '<option value="produit">Ajouter un produit</option>';
            			echo '<option value="photo">Ajout photo</option>';
            			echo '<option value="categorie">Ajout categorie</option>';
        		echo '</select> </div>';
			}
			else if ($_GET['page'] === "tissus") {
				echo '<div class="align">';
				echo '<select class="choix" name="choix">';
					echo '<option value="photo">Ajout photo</option>';
					echo '<option value="categorie">Ajouter une categorie</option>';
			echo '</select> </div>';
			}
		?>

			<!-- enctype pour envoyer le fichier au serveur et le stocker temporairement -->
		<div id="fichier">

		</div>

		<?php
			if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
				echo '<div class="message">'.htmlspecialchars($_SESSION['message']).'</div>';
				unset($_SESSION['message']);
			}
		?>
		
	<script>	const page = <?= json_encode($_GET['page']);  ?>;</script>
	<script src="../public/script/ajout.js"></script>
	</body>
</html>