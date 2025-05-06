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
session_start();

// stockage des données en session pour les récupérer dans reservation.php
$_SESSION['infos_parent'] = $_POST;
$nombreEnfants = (int)$_POST['nombre'];
?>
<div class="formulaire">
	<form action="../controller/reservation.php" method="post">
    		<?php for ($i = 1; $i <= $nombreEnfants; $i++): ?>
    				<h2>Enfant <?= $i ?></h2>
    				<label for="prenom_enfant_<?= $i ?>">Prénom</label>
    				<input type="text" name="enfants[<?= $i ?>][prenom]" required><br>
    
    				<label for="nom_enfant_<?= $i ?>">Nom</label>
    				<input type="text" name="enfants[<?= $i ?>][nom]" required><br>
    
    				<label for="naissance_enfant_<?= $i ?>">Date de naissance</label>
    				<input type="date" name="enfants[<?= $i ?>][naissance]" required><br>
    
    				<label for="alergies">Alergies</label>
    				<input type="text" name="enfants[<?= $i ?>][alergie]"><br>
    		<?php endfor; ?>
    
        <h2>Droit à l'image</h2>
        <p id="authorisation">
            J'autorise L'atelier des petites bulles à utiliser des photographies ou vidéos de mon enfant, 
            prises durant l’atelier, à des fins de communication (site internet, réseaux sociaux, supports imprimés).
        </p>
    
        <label class="radio">
            <input type="radio" name="droit_image" value="oui" required> Oui, j'autorise
        </label><br>
        <label class="radio">
            <input type="radio" name="droit_image" value="non" required> Non, je n'autorise pas
        </label><br><br>
    
        <label for="signature_parent">Signature (nom complet du parent) :</label><br>
        <input type="text" id="signature" name="signature" required>
    
    
    		<input type="submit" name="submit" value="enregistrer">
	</form>
</div>

</main>
</body>


<?php
	require_once 'layouts/footer.php';
?>