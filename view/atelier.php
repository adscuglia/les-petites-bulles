<?php
	$page = 'atelier';
	$debutTitre = "DECOUVREZ LES ";
	$finTitre = 'ATELIER';
	require_once 'layouts/header.php';
	require '../controller/bdd.php';
?>
		<!-- - - -  -  - --->
		<!-- - - main  - --->
		<!-- - - -  -  - --->
		
		<main>
		<section>

				<div class="align image-scotch" uk-lightbox>
						<img class="scotchHaut" src="../public/Image/all/Scotch1.svg" alt="image de scotch">
						<?php
							$image = derniereAffiche($bdd);
							echo '<img id="affiche" src="../public/Image/atelier/'.$image['url'].'" alt="'.$image['description'].'">';
						?>
						<img class="scotchBas" src="../public/Image/all/Scotch2.svg" alt="deuxieme image de scotch">
				</div>
				<div class="align">
					<h3>Envie de <span class="carton">créativité</span> ?</h3>  
					<p>
						Chaque mois, nos petits couturiers (dès <span class="carton">8 ans</span>) réalisent une création unique autour d’un <span class="carton">thème de saison</span> ou de fête. Retrouvez-nous au centre socio-culturel de <span class="carton">Basse-Ham</span> pour un atelier convivial !<br> <span class="carton">Participation : 22 €</span> (goûter inclus !)  
					</p>

					<button onclick="window.location.href = './reservation.php'" class="bu-def">RESERVER</button>
				</div>
		</section>

		<section>
    <h2>NOS ATELIERS PRÉCÉDENTS</h2>
    <div class="uk-slider-container" uk-grid>
        <!-- Onglets des années -->
        <div class="uk-width-1-1@m">
            <ul class="uk-width-auto date" uk-tab="connect: #date-switch; animation: uk-animation-fade">
                <?php
					$anneeValide = anneeAtelierPhoto($bdd);
					foreach($anneeValide as $annee) {
						echo '<li><a href="#">'.$annee.'</a></li>';
					}
                ?>
            </ul>
        </div>

        <!-- Contenu des onglets -->
        <div id="date-switch" class="uk-switcher" uk-slider>
            <?php
				foreach ($anneeValide as $annee) {
					$nomAtelier = atelierParAnnee($bdd, $annee);
					echo '<div>';
					echo '<ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">';
					foreach($nomAtelier as $nom) {
						echo '<li><a href="#">'.$nom['nom_atelier'].'</a></li>';
					}
					echo '</ul>';
					echo '<div class="uk-switcher uk-margin">';
					foreach ($nomAtelier as $nom) {
						echo '<div class="uk-slider-container uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider>';
						echo '<div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-3@l uk-grid" uk-lightbox="animation: fade">';
						foreach($nom['photos'] as $photo) {
							echo '<div class="uk-panel">';
							echo '<a href="../public/Image/atelier/'.$photo['url'].'">';
							echo '<img src="../public/Image/atelier/'.$photo['url'].'" alt="'.htmlspecialchars($photo['description']).'">';
							echo '</a>';
							echo '</div>';
						}
						echo '</div><a class="uk-position-center-left uk-position-small" href uk-slidenav-previous uk-slider-item="previous"></a><a class="uk-position-center-right uk-position-small" href uk-slidenav-next uk-slider-item="next"></a></div>';
					}
					echo '</div>';
					echo '<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>';
					echo '</div>';
					}
            ?>
		</div>
    </div>
</section>
		</main>
		<!-- fin contenu layout gauche -->
<?php
	require_once 'layouts/footer.php';
?>
			<script src="../public/script/nav.js"></script>
			<script src="../public/script/scroll.js"></script>
</body>
</html>
