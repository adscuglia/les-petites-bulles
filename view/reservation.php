<?php
	require_once '../controller/bdd.php';
	require '../controller/reservation.php';


	$dateFuture = atelierFuture($bdd);
?>

<!DOCTYPE html>
<html lang="FR">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css">
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
		<link rel="stylesheet" href="../public/style/produit.css">
		<link rel="stylesheet" href="../public/style/formulaire.css">
		<link rel="stylesheet" href="../public/style/footer.css">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>tissus</title>
	</head>
<body>

	<header>
		<nav>
			<div class="navlinks">
				<button class="menu-burger" type="button">
					<span></span>
					<span></span>
					<span></span>
				</button>

				<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>

				<div class="navlinks-container">
					<a href="../index.php">ACCUEIL</a>
					<a href="./propos.php">A PROPOS</a>
					<a href="./creation.php">PRODUITS</a>
					<a href="../index.php"><img src="../public/Image/all/logo.svg" alt="logo LPB" class="logo"></a>
					<a href="./atelier.php">LES ATELIERS</a>
					<a href="./tissus.php">TISSUS</a>
					<a href="./contact.php">CONTACT</a>
				</div>
			</div>
		</nav>

	</header>

	<main>
		<div class="formulaire">
			<form action="../controller/reservation.php" method="post">
				<label for="atelier">Date d'inscription</label>
				<select name="atelier">
					<option value="--Choisir un atelier--"></option>
				<?php
					foreach($dateFuture as $date) {
						echo '<option value="'.$date["n_Atelier"].'">',anneeSQL($date['Date_atelier']),'</option>';
					}
				?>
				</select><br>

					<!-- enfant a inscrire faire en php avec le nbr de place restante  -->
				<label for="nombre">Enfants à inscrire</label>
				<select name="nombre" id="nombre">
					<option value="">Choisissez un atelier d'abord</option>
				</select><br class="br-1">

				<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" required>
				<br>

				<label for="prenom">Prenom</label>
				<input type="text" id="prenom" name="prenom" required>
				<br>

				<label for="Date_naissance">Date de naissance</label>
				<input type=date id="Date_naissance" name="Date_naissance">
				<br>
				
				<label for="telephone">Téléphone</label>
				<div class="tel-group">
					<div class="prefixe-container">
						<select class="prefixe" id="prefixe" name="prefixe">
							<option value="+33">+33</option>
							<!-- Tu peux en ajouter d'autres si besoin -->
						</select>
					</div>
					<input type="text" id="telephone" name="telephone" pattern="[0-9]{9}" placeholder="612345678" required>
				</div>

				<label for="mail">Email</label>
				<input type="text" id="mail" name="mail" required>
				<br>

				<input name="submit" type="submit" value="Enregistrer">
				<input type="button" onclick="window.location.href = '../index.php'" value="Retour a l'accueil">
			</form>
		</div>
	</main>

	<script>
	const atelierSelect = document.querySelector('select[name="atelier"]');
	let nombreSelect = document.querySelector('select[name="nombre"]');
	let nombreLabel = document.querySelector('label[for="nombre"]');
	const nom = document.querySelector('label[for="nom"]');
	const form = document.querySelector('form');
	let br1 = document.querySelector('.br-1');

	atelierSelect.addEventListener('change', () => {
		const num = atelierSelect.value;
		const existMessage = document.querySelector('#complet');

		if (existMessage) {
			existMessage.remove();

			// Recrée les éléments
			nombreLabel = document.createElement('label');
			nombreLabel.setAttribute('for', 'nombre');
			nombreLabel.textContent = "Enfants à inscrire";

			nombreSelect = document.createElement('select');
			nombreSelect.setAttribute('name', 'nombre');
			nombreSelect.setAttribute('id', 'nombre');

			br1 = document.createElement('br');

			// Réinsertion dans le formulaire
			form.insertBefore(nombreLabel, nom);
			form.insertBefore(nombreSelect, nom);
			form.insertBefore(br1, nom);
		}

		// Appel du script PHP pour obtenir le nombre de places restantes
		fetch(`../model/place_restante.php?num=${num}`)
			.then(response => response.json())
			.then(data => {
				const max = data.places;

				nombreSelect.innerHTML = ''; // Vide le select

				if (max > 0) {
					for (let i = 1; i <= max; i++) {
						const option = document.createElement('option');
						option.value = i;
						option.textContent = i;
						nombreSelect.appendChild(option);
					}
				} else {
					nombreSelect.remove();
					nombreLabel.remove();
					br1.remove();

					const message = document.createElement('p');
					message.id = 'complet';
					message.textContent = "Complet";
					message.style.color = "red";

					form.insertBefore(message, nom);
				}
			})
			.catch(err => {
				console.error("Erreur fetch places :", err);
			});
	});
</script>

<?php
	require_once 'layouts/footer.php';
?>