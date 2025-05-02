<?php
	$page = 'propos';
	$debutTitre = "A PROPOS DE ";
	$finTitre = "L'ATELIER";
	require_once 'layouts/header.php';
?>

	<main>
			<article class="row">
				<p>
					Je suis maman de trois enfants et une grande fan de	couture. <span class="carton">Au fil du temps</span>, j'ai réalisé qu'il manquait des accessoires pour bébés et pour les parents à la fois pratiques et personnalisés. <span class="carton">J'ai donc lancé L'Atelier des Petites Bulles</span>, une petite entreprise dédiée à la création de pièces uniques pour les tout-petits, <span class="carton">avec l'amour du fait-main</span>. Chaque commande est une aventure créative où je m'efforce de répondre a vos attentes avec des <span class="carton">accessoires sur-mesure</span>.
				</p>

				<div class="image-scotch">
					<img id="scotchHaut" src="../public/Image/all/Scotch1.svg" alt="scotch">
					<img id="presentation" src="../public/Image/propos/marilyn-atelier.jpg" alt="mise en place d'un stand">
					<img id="scotchBas" src="../public/Image/all/Scotch2.svg" alt="Image de scotch">
				</div>
			</article>
			<p>
				Chaque article est fait sur commande, offrant ainsi la possibilité de choisir les tissus, les couleurs et les motifs. Que vous souhaitiez un prénom brodé ou un design unique, chaque création est un reflet de votre imagination et de mon savoir-faire.
			</p>
			
	</main>

	<?php
		require_once 'layouts/footer.php';
	?>
