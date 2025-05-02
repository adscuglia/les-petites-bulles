<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
	<link rel="stylesheet" href="../public/style/back.css">
</head>
<body>
    <h1>Connexion Back-Office</h1>

    <form action="../controller/connexion.php" method="POST" class="infos align">
		<?php
			if (isset($_SESSION['error'])) {
				echo '<div style="color:red; margin-bottom:15px;">'.$_SESSION['error'].'</div>';
				unset($_SESSION['error']);
			}
		?>
        <label>Nom d'utilisateur :</label>
        <input type="text" name="utilisateur" required><br>
        
        <label>Mot de passe :</label>
        <input type="password" name="mdp" required><br>
        
        <input type="submit" name="submit" value="Se connecter">
		<input onclick="window.location.href='../index.php'" type="button" value="Retour a l'accueil">
    </form>
</body>
</html>