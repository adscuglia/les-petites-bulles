<?php
session_start();

// Durée d'expiration en secondes (30sec x 1minute)
$sessionTimeout = 30 * 60;

// 1. Vérifie si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header('Location: connexion.php');
    exit;
}

// 2. Vérifie IP + user agent (sécurité anti-vol de session)
if ($_SESSION['admin']['ip'] !== $_SERVER['REMOTE_ADDR'] ||
    $_SESSION['admin']['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header('Location: /login.php');
    exit;
}

// 3. Vérifie l'expiration de la session
if (time() - $_SESSION['admin']['last_activity'] > $sessionTimeout) {
    session_unset();
    $_SESSION['error'] = 'La session a expiré veuillez vous reconnecter';
    header('Location:  ../view/connexion.php');
    exit;
}

// 4. Mise à jour de l'activité (tant qu'on est actif, on prolonge la session)
$_SESSION['admin']['last_activity'] = time();

?>