
<?php
	require '../controller/bdd.php';
	require '../controller/formulaire_devis.php';
	$message = '';
	$demande = '';
	if (!empty($_GET['numProduit']) && !empty($_GET['tissus'])) {
		$message = retourneMessage($bdd, htmlspecialchars($_GET['numProduit']), htmlspecialchars($_GET['tissus']) );
		$demande = 'Demande de devis';
	}
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
		
		<meta name="description" content="Une question sur les produits ou les ateliers ? Contactez-moi directement via cette page. Je vous répondrai rapidement avec plaisir.">
		
		    <meta property="og:title" content="L'Atelier des Petites Bulles - Contactez-moi directement via cette page.">
    <meta property="og:description" content="Une question sur les produits ou les ateliers ? Contactez-moi directement via cette page. Je vous répondrai rapidement avec plaisir.">
    <meta property="og:image" content="https://latelierdespetitesbulles.fr/public/Image/all/logo.svg">
    <meta property="og:url" content="https://latelierdespetitesbulles.fr/view/contact.php">
    <meta property="og:type" content="website">
    
        <link rel="icon" href="../public/Image/all/logo.svg" type="image/svg+xml">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
    if (isset($_GET['error']) && $_GET['error'] == 'captcha'): ?>
    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>La validation du CAPTCHA a échoué. Veuillez réessayer.</p>
    </div>
<?php endif; ?>
		<div class="formulaire">
			<form action="../controller/contact.php" method="post">

				<label for="demande">Objet de la demande : </label>
				<select name="demande">
				    <option value="Devis">Demande de devis</option>
				    <option value="atelier">Question a propos des ateliers</option>
				    <option value="autre">Autre</option>
				</select><br>

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
				<textarea id="message" name="message" required rows="12"><?php echo $message; ?></textarea>
				<br>
				
				<div class="g-recaptcha" data-sitekey="6Lcl-B0rAAAAAIATkeL8PvGjNAAxE_P8nnRhfMFG"></div>
				<input name="submit" type="submit" value="envoyer">
			</form>
				<input type="button" class="btn btn-cancel" onclick="window.location.href = '../index.php'" value="Retour a l'accueil">
		</div>

</main>

<?php
	require_once 'layouts/footer.php';
?>