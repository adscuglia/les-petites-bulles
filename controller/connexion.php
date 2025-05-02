<?php
session_start();
	require 'config.php';

	if(isset($_POST['submit'])){
		$utilisateur = $_POST['utilisateur'];
		$mdp = $_POST['mdp'];

		foreach ($admins as $admin) {
			if($utilisateur === $admin['utilisateur'] && password_verify($mdp, $admin['mdp'])) {
				$_SESSION['admin'] = [
					'id' => $admin['id'], // ou ton identifiant admin
					'ip' => $_SERVER['REMOTE_ADDR'],
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'last_activity' => time() // pour l'expiration
				];
				$_SESSION['admin_utilisateur'] = $admin['utilisateur'];
				$_SESSION['admin_name'] = $admin['name'];
				header('Location: ../view/back_office.php');
				exit;
			}
		}
		$_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe incorect';
		header('Location: ../view/connexion.php');
		exit;
	}
?>