<?php
	require_once '../controller/bdd.php';

	$categorie_produitManager = new Categorie_produitManager($bdd);
	$categories = $categorie_produitManager->getAllCategorie();
?>
<main>
	<form action="../controller/ajout_produit.php?ajout=categorie" method="post">
		<div class="formulaire">
				<label>Nom Categorie</label>
				<input type="text" name="nom"  required>

				<input type="submit" name="submit">
				<input type="button" onclick="window.location.href = 'back_office.php'" value="Retour au back office">
		</div>
	</form>

	<?php
echo '<table>';
echo '
    <thead>
        <tr>
            <th>Nom</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>';
    
foreach ($categories as $categorie) {
    echo '
        <tr>
            <td>' . htmlspecialchars($categorie['nom_categorie']) . '</td>
            <td>
                <input class="supprimer" type="button" value="Supprimer" data-id="' . (int)$categorie['id_categorie'] . '">
            </td>
        </tr>';
}

echo '
    </tbody>
</table>';
?>

	</div>
</main>