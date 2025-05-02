<?php
		// voir les erreurs php
		// error_reporting(E_ALL);
		// ini_set('display_errors', 1);

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	require_once '../controller/bdd.php';
		// recupere les dates et n des ateliers
	function atelierFuture($bdd) {
		$atelier = new AtelierManager($bdd);
		$dateAtelier = $atelier->getAteliersFuture();
		return $dateAtelier;
	}

	function nombreInscris($bdd, $num) {
		$atelier = new AtelierManager($bdd);
		return  $atelier->nbrInscris($num);
	}

	if(isset($_POST['submit'])) {
		$post = [
			'Nom_client' => htmlspecialchars($_POST['nom']),
			'Prenom_client' => htmlspecialchars($_POST['prenom']),
			'Date_naissance' => htmlspecialchars($_POST['Date_naissance']),
			'n_tel' => htmlspecialchars($_POST['prefixe']). ' ' . htmlspecialchars($_POST['telephone']),
			'Mail' => htmlspecialchars($_POST['mail']),
		];
		$newClient = new ClientManager($bdd);
		$client = new Client();
		$inscription = new InscrireManager($bdd);
		$atelier = new AtelierManager($bdd);
		$client->hydrate($post);
		$id = $newClient->getIdAvecMail($post['Mail']);
		
		if ($id == false) {
			$newClient->add($client);
			$id = $newClient->getIdAvecMail($post['Mail']);
		}
		else {
			$newClient->update($client, $id);
		}
		$inscription->add(htmlspecialchars($_POST['atelier']) , $id, htmlspecialchars($_POST['nombre'] ));
		$date = $atelier->getDateAvecN_atelier(htmlspecialchars($_POST['atelier']));
		$date = anneeSQL($date);

		try {
			// Vérification des champs obligatoires
			if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['mail']) || empty($_POST['message'])) {
				throw new Exception('Tous les champs requis ne sont pas remplis.');
			}

			// Sécurisation des données
			$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$telephone = htmlspecialchars($_POST['prefixe']) . ' ' . htmlspecialchars($_POST['telephone']);
			$email = htmlspecialchars($_POST['mail']);
			$message = 'Inscription a l\'atelier du '.$date.' pour '.htmlspecialchars($_POST['nombre'] );
			$demande = 'Inscription';

				// Envoi du mail à LPB
			$mailLPB = new PHPMailer(true);
			$mailLPB->isSMTP();
			$mailLPB->Host = 'latelierdespetitesbulles.fr';
			$mailLPB->SMTPAuth = true;
			$mailLPB->Username = 'contact@latelierdespetitesbulles.fr';
			$mailLPB->Password = 'Zp4r]07!f9bk';
			$mailLPB->SMTPSecure = 'ssl';
			$mailLPB->Port = 465;

			$mailLPB->setFrom('contact@latelierdespetitesbulles.fr', 'l\'atelier des petites bulles');
			$mailLPB->addAddress('contact@latelierdespetitesbulles.fr');
			$mailLPB->isHTML(true);
			$mailLPB->Subject = $demande;

			// Logo intégré
			$logoPath = '../public/Image/all/logo.png';
			if (file_exists($logoPath)) {
				$mailLPB->addEmbeddedImage($logoPath, 'logo_lpb', 'logo.png', 'base64', 'image/png');
				$logoHtml = "<img src='cid:logo_lpb' alt='Logo LPB' width='150'>";
			} else {
				$logoHtml = "";
			}

			$mailLPB->Body = "
				<h2>Nouvelle demande d\inscription</h2>
				<p><b>Nom :</b> $nom</p>
				<p><b>Prénom :</b> $prenom</p>
				<p><b>Téléphone :</b> $telephone</p>
				<p><b>Email :</b> $email</p>
				<p><b>Message :</b><br>$message</p>
				<br>
				$logoHtml
			";
			
			$mailLPB->addReplyTo($email, $prenom . ' ' . $nom);
			$mailLPB->send();

			// Envoi du mail au client
			$mailClient = new PHPMailer(true);
			$mailClient->isSMTP();
			$mailClient->Host = 'latelierdespetitesbulles.fr';
			$mailClient->SMTPAuth = true;
			$mailClient->Username = 'contact@latelierdespetitesbulles.fr';
			$mailClient->Password = 'Zp4r]07!f9bk';
			$mailClient->SMTPSecure = 'ssl';
			$mailClient->Port = 465;

			$mailClient->setFrom('contact@latelierdespetitesbulles.fr', 'l\'atelier des petites bulles');
			$mailClient->addAddress($email, $prenom . ' ' . $nom);
			$mailClient->isHTML(true);
			$mailClient->Subject = $demande;
			
			if (file_exists($logoPath)) {
				$mailClient->addEmbeddedImage($logoPath, 'logo_lpb', 'logo.png', 'base64', 'image/png');
				$logoHtml = "<img src='cid:logo_lpb' alt='Logo LPB' width='150'>";
			} else {
				$logoHtml = "";
			}

		$mailClient->Body = '
		<div style="background-color: #51816a; padding: 50px; border-radius:10px; margin: auto; width: 500px;" font-family: Arial, sans-serif; color: #333;">
			<div style="text-align: center;">
				<img style="text-align: center; width: 120px; margin-bottom: 20px;" src="cid:logo_lpb" alt="Logo Petites Bulles">
			</div>
				<h2 style="text-align: center; color: #f0ddc9;">Merci pour votre message !</h2>
				<p>Bonjour ' . $prenom . ',</p>
				<p>Nous avons bien enregistré votre inscription à l\'atelier du <strong>'.$date.'</strong> pour <strong>'.$htmlspecialchars($_POST['nombre'] ).'</strong> !</p>
				<p>Un grand merci pour votre confiance ! 🎉</p>
				<p>En cas de question ou d\'empêchement, n\'hésitez pas à nous contacter à <a href="mailto:contact@latelierdespetitesbulles.fr">contact@latelierdespetitesbulles.fr</a>.</p>
				<p>À très bientôt,<br><b><p style="text-align:center;">l\'atelier des petites bulles</b></p></p>
			</div>
		';

			$mailClient->send();

			// Redirection propre après envoi
			header('Location: ../view/confirmation.php?message=contact');
			exit;

		} catch (Exception $e) {
			// Seulement afficher en cas d'erreur
			echo "Erreur : " . $e->getMessage();
		}
	}
?>