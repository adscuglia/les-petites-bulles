<?php
	require '../controller/bdd.php';

	if (isset($_GET['num'])) {
		$num = $_GET['num'];
		$photoProduitManager = new photo_produitManager($bdd);
		$photos = $photoProduitManager->getPhotoAvecProduit($num);
		$produitManager = new produitManager($bdd);
		$produit = $produitManager->getProduitParNum($num);
		$autreProduits = $produitManager->getProduitParCategorie($produit['id_categorie_produit'], $num);
		
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
		
		<link rel="icon" href="../public/Image/all/logo.svg" type="image/svg+xml">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>produit</title>
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
	<!--<div class="container">-->
	<!--	<h2>Vous voulez le votre ?</h2>-->
	<!--	<p>Demandez un devis personnalisé en sélectionnant vos tissus préférés.</p>-->
	<!--</div>-->
<div class="fiche-produit">
	<div class="fiche-gauche">
		<div class="fiche-image-principale">
			<img id="mainImage" src="../public/Image/produit/<?php echo $photos[0]['url']; ?>" alt="Produit principal">
		</div>

		<div class="fiche-miniatures">
			<?php foreach($photos as $photo): ?>
				<img class="fiche-miniature" src="../public/Image/produit/<?php echo $photo['url']; ?>" alt="Miniature">
			<?php endforeach; ?>
		</div>
	</div>

	<div class="fiche-droite">
		<?php
		    echo '<h3>'.$produit['nom_produit'].'</h3>' ;
		    echo '<p>'.$produit['prix_TTC'].' €</p>';
		    echo '<p>'.$produit['descriptif_produit'].'</p>';
		?>
        <ul>
            <li>🌿 100% coton doux et naturel</li>
            <li>✅ Tissus certifiés Oeko-Tex® </li>
            <li>🤲 Fabriqué à la main avec passion</li>
            <li>🎨 Personnalisation offerte (prénom, motif, couleur...)</li>
        </ul>
        <input onclick="window.location.href='choix_tissus.php?num=<?php echo $_GET['num']; ?>'" class="bu-def" type="button" value="Choisissez vos tissus">
	</div>
</div>
	<div id="autre-article">
		<h4>Article similaire</h4>
			<?php 
				foreach ($autreProduits as $autreProduit) {
					$photo = $photoProduitManager->getPremierePhotoProduit($autreProduit['n_produit']);

					if ($photo && !empty($photo['url'])) {
						echo '<a href="photo_produit.php?num=' . $autreProduit['n_produit'] . '">';
						echo '<img src="../public/Image/produit/' . htmlspecialchars($photo['url']) . '" alt="Miniature">';
						echo '</a>';
					}
				}
			?>

	</div>

</main>

<script src="../public/script/affichageProduit.js"></script>

<?php
	require_once 'layouts/footer.php';
?>
