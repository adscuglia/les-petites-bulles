<?php
require_once '../controller/bdd.php';
require_once  '../controller/client.php';

$clients = retourneClient($bdd);

echo '<table>';
echo '<tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Supprimer</th>
      </tr>';

foreach ($clients as $client) {
    echo '<tr>';
    echo '<td>' . $client['Nom_client'] . '</td>';
    echo '<td>' . $client['Prenom_client'] . '</td>';
    echo '<td>' . anneeSQL($client['Date_naissance']) . '</td>';
    echo '<td>' . $client['n_tel'] . '</td>';
    echo '<td>' . $client['Mail'] . '</td>';
    echo '<td><input class="supprimer" type="button" value="supprimer" data-id="' . $client['ID_client'] . '" data-nom="'. $client['Nom_client'] . ' ' . $client['Prenom_client'] .'"></input></td>';
    echo '</tr>';
}

echo '</table>';
?>