<?php
require '../controller/bdd.php';

if (isset($_GET['num'])) {
    $num = $_GET['num'];
	$atelier = new AtelierManager($bdd);
    $placesRestantes = $atelier->placeRestante($num);
    echo json_encode(['places' => $placesRestantes['places']]);
}
?>