<?php
	$page = 'tissus';
	$debutTitre = 'LES ';
	$finTitre = 'TISSUS';
	require_once 'layouts/header.php';
	require '../controller/bdd.php';
	$tissusManager = new TissusManager($bdd);
	$tissus = $tissusManager->getALL();
	$categoriesManager = new CategorieManager($bdd);
	$categories = $categoriesManager->getAll();
?>

<main>
	<div class="container">
		<label>Filtrer par categorie</label><br>
		<select class="choix-tissus">
			<option value="Tout">Tout les tissus</option>
			<?php
				foreach($categories as $categorie) {
					echo '<option value="'.$categorie['id_categorie'].'">'.ucfirst($categorie['nom_categorie']).'</option>';
				}
			?>
		</select>
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
<script src="../public/script/filtreTissus.js"></script>

<?php
	require_once 'layouts/footer.php';
?>
