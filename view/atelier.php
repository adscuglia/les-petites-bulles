<?php
	$page = 'atelier';
	$titre = "Ateliers pour enfants - L'atelier des petites bulles";
	$debutTitre = "DECOUVREZ <br>";
	$finTitre = 'LES ATELIERS';
	$description = "L'Atelier des Petites Bulles à Basse-Ham (Moselle) propose des ateliers de couture créatifs pour enfants a partir de 8 ans. Initiation aux techniques textiles dans un cadre ludique. Réservation en ligne. Activités manuelles éducatives près de Thionville et Metz.";
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
						Chaque mois, l'Atelier des Petites Bulles<br> propose  des <span class="carton">ateliers couture</span><br> enfants (<span class="carton">dès 8ans</span>)
						ou adultes,<br> sur un thème de <span class="carton">saison</span> ou de <span class="carton">fête</span>.<br><br> Retrouvez-moi à <span class="carton">Basse-Ham</span> <br> au Centre Socioculturel<br>pour un moment <span class="carton">convivial</span> !<br><br>
					    Participation : 22 € <span class="carton"> ! GOÛTER OFFERT !</span>
					</p>

					<button onclick="window.location.href = './reservation.php'" class="bu-def">RESERVER</button>
				</div>
		</section>

		<section>
    <h2>LES ATELIERS PRÉCÉDENTS</h2>
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
