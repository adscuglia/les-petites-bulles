<?php
require '../controller/bdd.php';
require '../controller/client_inscris.php';

$num = $_GET['num'];
$clients = retourneClient($bdd, $num);

// Filtrer les clients réellement inscrits (évite la ligne "vide")
$clients = array_filter($clients, function($client) {
    return !is_null($client['ID_client']);
});


if (!empty($clients)) {
	echo '<table>';
echo '<tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>nombre d\'inscris</th>
        <th>Supprimer</th>
      </tr>';

foreach ($clients as $client) {
	$nomComplet = ($client['Nom_client'] . ' ' . $client['Prenom_client']);
    echo '<tr>';
    echo '<td>' . $client['Nom_client'] . '</td>';
    echo '<td>' . $client['Prenom_client'] . '</td>';
    echo '<td>' . $client['n_tel'] . '</td>';
    echo '<td>' . $client['Mail'] . '</td>';
    echo '<td>' . $client['nbr_inscription'] . '</td>';
    echo '<td><input class="supprimer" type="button" value="supprimer" data-id="' . $client['ID_client'] . '" data-num="'. $num . '" data-nom="'. $nomComplet .'"></input></td>';
    echo '</tr>';
}

echo '</table>';
}
else {
    echo '<h1>Personne n\'est inscrit pour le moment</h1>';
}
echo '<input class="bu-sec" type="button" value="Retour aux ateliers"></input>';
?>