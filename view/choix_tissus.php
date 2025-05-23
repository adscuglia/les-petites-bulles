
<?php
	require '../controller/bdd.php';
	$tissusManager = new TissusManager($bdd);
	$tissus = $tissusManager->getALL();
	$categoriesManager = new CategorieManager($bdd);
	$categories = $categoriesManager->getAll();
	
	if (!empty($_GET['num']) && isset($_GET['num'])) {
		$produit = new ProduitManager($bdd);
		$produit = $produit->getProduitParNum($_GET['num']);
		$nomProduit = $produit['nom_produit'];
	}

	if (!empty($_GET['coffret']) && isset($_GET['coffret'])) {
		$coffret = new CoffretManager($bdd);
		$produit = $coffret->getAllParId($_GET['coffret']);
		$nomProduit = $produit['nom_coffret'];
		
	}
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
					<a href="./creation.php">CREATIONS</a>
					<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
					<a href="./atelier.php">LES ATELIERS</a>
					<a href="./tissus.php">TISSUS</a>
					<a href="./contact.php">CONTACT</a>
				</div>
			</div>
		</nav>

	</header>


<main>
	<div class="container">
		<h2>Cliquez sur un tissus pour completer votre demande</h2>
		<label>Filtrer par categorie : </label>
		<select class="choix-tissus">
			<option value="Tout">Tout les tissus</option>
			<?php
				foreach($categories as $categorie) {
					echo '<option value="'.$categorie['id_categorie'].'">'.ucfirst($categorie['nom_categorie']).'</option>';
				}
			?>
		</select><br>
		<?php echo '<input class="bu-sec" id="valider" data-produit="'.$nomProduit.'" type="button" value="Valider ma selection">';?>
		
	</div>

	<div class="grille">
	<?php 
		foreach($tissus as $tissu) {
			echo '<div class="carte" data-categorie="'.$tissu['id_categorie'].'" data-id="'.$tissu['n_tissus'].'">';
			echo '<div class="image">';
				echo '<img src="../public/Image/tissus/'.$tissu['url_tissus'].'" alt="'. $tissu['nom_tissus'].'">';
			echo '</div>';
			echo '</div>';
		}
	?>
	</div>

</main>

<script src="../public/script/tissus.js"></script>
<script src="../public/script/filtreTissus.js"></script>

<?php
	require_once 'layouts/footer.php';
?>