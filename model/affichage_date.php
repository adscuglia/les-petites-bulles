<?php
require '../controller/bdd.php';
require '../controller/date_atelier.php';

$ateliers = retourneDate($bdd);

echo '<table>';
echo '<tr>
        <th>Date de l\'atelier</th>
        <th>Nom de l\'atelier</th>
        <th>nombre d\'inscris</th>
        <th>Supprimer</th>
        <th>inscription</th>
      </tr>';

foreach ($ateliers as $atelier) {
    $inscris = nombreInscris($bdd, $atelier['n_Atelier']);
    echo '<tr>';
    echo '<td>' . anneeSQL($atelier['Date_atelier']) . '</td>';
    echo '<td>' . $atelier['nom_atelier'] . '</td>';
    echo '<td>'.$inscris.'</td>';
    echo '<td><input class="supprimer" type="button" value="supprimer" data-num="' . $atelier['n_Atelier'] . '" data-date="'. anneeSQL($atelier['Date_atelier']) .'"></input></td>';
    echo '<td><input class="voir" type="button" value="Voir les inscris" data-num="' . $atelier['n_Atelier'] . '"></input></td>';
    echo '</tr>';
}

echo '</table>';
?>