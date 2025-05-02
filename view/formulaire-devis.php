
<?php
	require '../controller/bdd.php';
	require '../controller/formulaire_devis.php';
	$message = retourneMessage($bdd, htmlspecialchars($_GET['numProduit']), htmlspecialchars($_GET['tissus']) );

?>

<!DOCTYPE html>
<html lang="FR">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css">
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
		<link rel="stylesheet" href="../public/style/produit.css">
		<link rel="stylesheet" href="../public/style/formulaire.css">
		<link rel="stylesheet" href="../public/style/footer.css">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>tissus</title>
	</head>
<body>

	<header>
		<nav>
			<div class="navlinks">
				<button class="menu-burger" type="button">
					<span></span>
					<span></span>
					<span></span>
				</button>

				<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>

				<div class="navlinks-container">
					<a href="../index.php">ACCUEIL</a>
					<a href="./propos.php">A PROPOS</a>
					<a href="./creation.php">PRODUITS</a>
					<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
					<a href="./atelier.php">LES ATELIERS</a>
					<a href="./tissus.php">TISSUS</a>
					<a href="./contact.php">CONTACT</a>
				</div>
			</div>
		</nav>

	</header>


<main>
	<?php
		
	?>
		<div class="formulaire">
			<form action="../controller/reservation.php" method="post">
				<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" required>
				<br>

				<label for="prenom">Prenom</label>
				<input type="text" id="prenom" name="prenom" required>
				<br>

				<label for="telephone">Téléphone</label>
				<div class="tel-group">
					<div class="prefixe-container">
						<select class="prefixe" id="prefixe" name="prefixe">
							<option value="+33">+33</option>
						</select>
					</div>
					<input type="text" id="telephone" name="telephone" pattern="[0-9]{9}" placeholder="612345678" required>
				</div>

				<label for="mail">Email</label>
				<input type="text" id="mail" name="mail" required>
				<br>

				<label for="message">Message</label><br>
				<textarea id="message" name="message" required rows="6"><?php echo $message; ?></textarea>
				<br>

				<input name="submit" type="submit" class="btn btn-submit" value="Enregistrer">
				<input type="button" class="btn btn-cancel" onclick="window.location.href = '../index.php'" value="Retour a l'accueil">
			</form>
		</div>

</main>

<?php
	require_once 'layouts/footer.php';
?>