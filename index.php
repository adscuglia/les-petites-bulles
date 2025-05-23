<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO META -->
    <title>L'Atelier des Petites Bulles - Créations personnalisées et ateliers pour enfants</title>
    <meta name="description" content="L'Atelier des Petites Bulles à Basse-Ham : créations personnalisées pour bébés et enfants, ateliers créatifs, cadeaux faits main près de Thionville.">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Facebook, Instagram, WhatsApp...) -->
    <meta property="og:title" content="L'Atelier des Petites Bulles - Créations personnalisées et ateliers pour enfants">
    <meta property="og:description" content="Découvrez nos articles faits main pour bébés et nos ateliers créatifs pour enfants à Basse-Ham, Moselle.">
    <meta property="og:image" content="https://latelierdespetitesbulles.fr/public/Image/all/logo.svg">
    <meta property="og:url" content="https://latelierdespetitesbulles.fr/">
    <meta property="og:type" content="website">

    <!-- Google Verification -->
    <meta name="google-site-verification" content="_fVBijaHzVfiT76MWN5uYAAz5Wu4STuJzVm123Vxk5Y" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css">
    <link rel="stylesheet" href="public/style/header.css">
    <link rel="stylesheet" href="public/style/accueil.css">
    <link rel="stylesheet" href="public/style/footer.css">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js" defer></script>

    <!-- Favicon -->
    <link rel="icon" href="public/Image/all/logo.svg" type="image/svg+xml">
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

				<a href="index.php"><img src="public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>

				<div class="navlinks-container">
					<a href="index.php">ACCUEIL</a>
					<a href="view/propos.php">A PROPOS</a>
					<a href="view/creation.php">CREATIONS</a>
					<a href="index.php"><img src="public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
					<a href="view/atelier.php">ATELIERS</a>
					<a href="view/tissus.php">TISSUS</a>
					<a href="view/contact.php">CONTACT</a>
				</div>
			</div>
		</nav>
		<div class="header-gauche">
			<h1>L'ATELIER DES <span class="carton">PETITES BULLES</span></h1>
			<div class="header-bu-index">
				<button onclick="window.location.href = 'view/creation.php'" class="bu-def" id="produit">LES CREATIONS </button>
				<button onclick="window.location.href = 'view/atelier.php'" class="bu-def" id="atelier">LES ATELIERS</button>
			</div>
		</div>
	</header>
	
	<main>
		<section>
			<p>
                Bienvenue dans l’univers doux et créatif<br> de <span class="carton">l’Atelier des Petites Bulles</span>,<br>
                où les tissus prennent vie<br> pour raconter de <span class="carton">jolies histoires</span>.
			</p>
		</section>

		<section>
			<h2>LES COFFRETS DISPONIBLES</h2>
			<div class="uk-slider-container" uk-slider>
				<div class="uk-position-relative uk-visible-toggle uk-light">
					<div class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-grid">
						
					</div>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>
				</div>

				<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
			</div>

		</section>

		<section>
			<h2>LES ATELIERS POUR ENFANTS</h2>
			<div class="divise2">
				<div>
					<p>
						Vous êtes à la recherche d'une <span class="carton">activité <br>ludique et enrichissante</span>  pour vos enfants ?<br><br>
						L'Atelier des Petites Bulles <br> accueille vos couturiers en herbe <span class="carton">dès 8 ans</span>, <br>
						pour des <span class="carton">ateliers créatifs</span> de couture<br> où ils apprennent à coudre en <span class="carton">s'amusant</span> <br> et en développant leur <span class="carton">créativité</span>. <br><br>
						A l'issue de l'<span class="carton">atelier</span> couture,<br> chaque enfant repart avec sa <span class="carton">création</span>.
						
					</p>

					<div class="align">
						<button onclick="window.location.href = 'view/atelier.php'" class="bu-def">Plus d'info</button>
						<button onclick="window.location.href = 'view/reservation.php'" class="bu-def">Reserver</button>
					</div>
				</div>
				<div class="image-scotch">
					<img class="scotchHaut" src="public/Image/all/Scotch1.svg" alt="scotch">
					<img class="photo" src="public/Image/atelier/Halloween_enfant2.jpg" alt="enfant">
					<img class="scotchBas" src="public/Image/all/Scotch2.svg" alt="scotch">
				</div>
			</div>
		</section>

	</main>

	<footer>
		<a href="./accueil.html"><img src="public/Image/all/logo-negatif.svg" alt="logo LPB" class="logo"></a>
		
		<div>
			<h4>L'atelier des petites bulles </h4>
			<p>
				Ici, l’amour du fait-main<br>donne vie à des pièces uniques,<br> où chaque détail raconte<br> un peu de votre histoire.
			</p>
		</div>
		
		<div>
			<h4>Contact</h4>

			<div>
				<img src="public/Image/footer/position-vert.svg" alt="logo position"> Basse-Ham (57970) <br>
			</div>
			
			<div>
				<img src="public/Image/footer/telephone-vert.svg" alt="tel"> +33 6 03 71 18 72 <br>
			</div>
			
			<a href="mailto:contact@latelierdespetitesbulles.fr" target="_blank"><img src="public/Image/footer/courrier-vert.svg" alt="courrier"> contact@latelierdespetitesbulles.fr</a>
			<div id="reseaux"> 
				<a class="logosupp" href="https://m.facebook.com/100088395311775/" target="_blank"><img src="public/Image/footer/facebook.svg" alt="logo facebook" ></a>
				<a class="logosupp" href="https://www.instagram.com/latelier.des.petites.bulles/" target="_blank"><img src="public/Image/footer/instagram.svg" alt="logo instagram"></a>
			</div>
		</div>
		
		<div>
			Copyright © 2024 - <a href="https://www.linkedin.com/in/adrien-scuglia-80320b312/recent-activity/all/" target="_blank">SCUGLIA Adrien</a> - <a href="view/connexion.php">Administrateur</a> - <a href="view/mentionLegale.html" target="_blank" >Mentions légales</a> - <a href="view/politique.html" target="_blank">Politique de confidentialité</a>
		</div>
	</footer>

	<script src="public/script/nav.js"></script>
	<script src="public/script/index.js"></script>
</body>
</html>
