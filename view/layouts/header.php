<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
    <link rel="stylesheet" href="../public/style/header.css">
    <link rel="stylesheet" href="../public/style/<?php echo $page ?>.css">
    <link rel="stylesheet" href="../public/style/footer.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favicon -->
    <link rel="icon" href="../public/Image/all/logo.svg" type="image/svg+xml">

    <?php if (isset($titre)) {
        echo '<title>'. htmlspecialchars($titre) .'</title>';
        echo '<meta property="og:title" content="'. htmlspecialchars($titre) .'">';
    } else {
        echo '<title>L\'atelier des petites bulles</title>';
        echo '<meta property="og:title" content="L\'atelier des petites bulles">';
    } ?>

    <?php if (isset($description)) {
        echo '<meta name="description" content="'. htmlspecialchars($description) .'">';
        echo '<meta property="og:description" content="'. htmlspecialchars($description) .'">';
    } ?>

    <meta property="og:image" content="https://latelierdespetitesbulles.fr/public/Image/all/logo.svg">
    <meta property="og:url" content="https://latelierdespetitesbulles.fr">
    <meta property="og:type" content="website">

    <meta name="google-site-verification" content="_fVBijaHzVfiT76MWN5uYAAz5Wu4STuJzVm123Vxk5Y" />
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
					<a href="./atelier.php">ATELIERS</a>
					<a href="./tissus.php">TISSUS</a>
					<a href="./contact.php">CONTACT</a>
				</div>
			</div>
		</nav>
		<?php
			if (isset($debutTitre) && isset($finTitre)) {
				echo '<h1>'. $debutTitre.'<span class="carton">'. $finTitre.'</span></h1>';
			}
		?>

		<div class="header-bu">
			<button class="fleche">
				<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path stroke-opacity="0.7" d="M50 80L20 50M50 80L80 50M50 80V20" stroke="#333" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>
	</header>