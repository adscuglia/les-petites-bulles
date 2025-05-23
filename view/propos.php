<?php
    $page = 'propos';
    $titre = "À propos - L'atelier des petites bulles";
    $debutTitre = "A PROPOS ";
    $finTitre = "DE L'ATELIER";
    $description = "Découvrez l'histoire de l'Atelier des Petites Bulles, mon histoire, mes valeurs et surtout ma passion pour la création artisanale destinée aux enfants. à Basse-Ham en Moselle.";
    require_once 'layouts/header.php';
?>

	<main>
			<article class="row">
				<p>
                    Je suis Marilyn, maman de 3 enfants.<br>
                    Créatrice <span class="carton">passionnée</span> et <span class="carton">autodidacte</span><br> située à Basse-Ham dans l'<span class="carton">Est de la France</span>.<br><br>
                    En <span class="carton">2014</span>, j’ai fait naître l’Atelier des Petites Bulles<br> avec l’envie de valoriser le <span class="carton">savoir-faire artisanal</span>,<br>
                    de proposer des créations couture uniques,<br>
                    <span class="carton">faites main</span> et personnalisables,<br> pour <span class="carton">petits et grands</span> rêveurs.<br><br>
                    Je vous propose également des <span class="carton">ateliers</span><br> afin de <span class="carton">découvrir</span> la couture<br>
                    et de développer votre <span class="carton">créativité</span>. 
				</p>

				<div class="image-scotch">
					<img id="scotchHaut" src="../public/Image/all/Scotch1.svg" alt="scotch">
					<img id="presentation" src="../public/Image/propos/marilyn-atelier.jpg" alt="mise en place d'un stand">
					<img id="scotchBas" src="../public/Image/all/Scotch2.svg" alt="Image de scotch">
				</div>
			</article>
			<p>
			    Entièrement faite à la main,<br> chaque création est unique.<br>
                Ses petites singularités témoignent<br> de son authenticité et de l’amour<br> avec lequel elle a été confectionnée.<br><br>
			</p>
			
	</main>

	<?php
		require_once 'layouts/footer.php';
	?>
