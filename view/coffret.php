<?php
	require '../controller/bdd.php';

	$id = $_GET['coffret'];
	$integrerManager = new IntegrerManager($bdd);
	$produits = $integrerManager->getAllProduitUnCoffret($id);
	$photoManager = new Photo_produitManager($bdd);
?>

<!DOCTYPE html>
<html lang="FR">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css">
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
		<link rel="stylesheet" href="../public/style/produit.css">
		<link rel="stylesheet" href="../public/style/footer.css">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>coffret</title>
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
					<a href="./creation.php">CREATIONS</a>
					<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
					<a href="./atelier.php">LES ATELIERS</a>
					<a href="./tissus.php">TISSUS</a>
					<a href="./contact.html">CONTACT</a>
				</div>
			</div>
		</nav>

	</header>

<main>
	<div class="container">
		<h2>Vous voulez votre coffret ?</h2>
		<p>Demandez un devis personnalisé en sélectionnant vos tissus préférés.</p>
		<input onclick="window.location.href='choix_tissus.php?coffret=<?php echo $id; ?>'" class="bu-sec" type="button" value="Choisissez vos tissus">
	</div>

	<h3> Qui a t'il dans le coffret ? </h3>
	<ul>
		<?php
			foreach($produits as $produit) {
				echo '<li>'.$produit['nom_produit'].'</li>';
			}
		?>
	</ul>

	<h3> Plus de photos des produits</h3>
	<div class="grille">
		<?php
			foreach($produits as $produit) {
				$photos = $photoManager->getPhotoAvecProduit($produit['n_produit']);
				foreach ($photos as $photo) {
					echo '<div class="carte">';
					echo '<div class="image">';
						echo '<img src="../public/Image/produit/'.$photo['url'].'">';
					echo '</div></div>';

				}

			}
		?>
	</div>
</main>

<?php
	require_once 'layouts/footer.php';
?>
