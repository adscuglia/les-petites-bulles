<?php
    require_once '../controller/authorisation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/back.css">
    <title>base de donées</title>
</head>
<body>
    <header>
		<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
	</header>
    <div class="align">
        <select name="choix_info">
            <option>-- choix de la categorie --</option>
            <option value="client">client</option>
            <option value="date">date atelier</option>
            <option value="produit">produit</option>
        </select>
    </div>
    <input onclick="window.location.href='back_office.php'" type="button" class="bu-sec" value="retour"></input>

    <div id="fichier">

    </div>


	<script src="../public/script/info.js"></script>
</body>
</html>