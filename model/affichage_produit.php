<?php
require '../controller/bdd.php';
require '../controller/affichage_produit.php';

$produits = retourneProduit($bdd);

echo '<table>';
echo '<tr>
        <th>Nom du produit</th>
        <th>Descriptif du produit</th>
        <th>prix</th>
        <th>modifier</th>
		<th>Photo</th>
        <th>Supprimer</th>
      </tr>';

foreach ($produits as $produit) {
    echo '<tr>';
    echo '<td>'. $produit['nom_produit'] .'</td>';
    echo '<td>' . $produit['descriptif_produit'] . '</td>';
    echo '<td>'.$produit['prix_TTC'].'</td>';
    echo '<td><input class="modifier" type="button" value="Modifier prix" data-num="' . $produit['n_produit'] . '" data-nom="'.$produit['nom_produit'].'"></td>';
	echo '<td><input class="photo" type="button" value="Voir Photo" data-num="' . $produit['n_produit'] . '"></td>';
    echo '<td><input class="supprimer" type="button" value="supprimer" data-num="'.$produit['n_produit'].'" data-nom="'.$produit['nom_produit'].'"></td>';
    echo '</tr>';
}

echo '</table>';
?>