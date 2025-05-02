<?php
    // voir les erreurs php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../public/lib/PHPMailer/Exception.php';
require '../public/lib/PHPMailer/PHPMailer.php';
require '../public/lib/PHPMailer/SMTP.php';

try {
    // Vérification des champs obligatoires
    if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => '6Lcl-B0rAAAAAJOptWAtuGjICsdxpDNn_g_SsoY5',
        'response' => $recaptcha
    ];
    
    // Initialiser la requête CURL
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true
    ];
    
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $result = json_decode($response, true);
    
    if ($result['success']) {
        // Ici : le CAPTCHA est validé ✅
        // Traiter normalement le formulaire
    } else {
        // Ici : CAPTCHA invalide ❌
    header('Location: ../view/contact.php?error=captcha');
    exit;

    }
}
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['mail']) || empty($_POST['message'])) {
        throw new Exception('Tous les champs requis ne sont pas remplis.');
    }

    // Sécurisation des données
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['prefixe']) . ' ' . htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['mail']);
    $message = nl2br(htmlspecialchars($_POST['message']));
    $demande = htmlspecialchars($_POST['demande']);

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
        <h2>Nouvelle demande de contact</h2>
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
    $mailClient->Subject = 'Merci pour votre message !';
    
    if (file_exists($logoPath)) {
        $mailClient->addEmbeddedImage($logoPath, 'logo_lpb', 'logo.png', 'base64', 'image/png');
        $logoHtml = "<img src='cid:logo_lpb' alt='Logo LPB' width='150'>";
    } else {
        $logoHtml = "pas trouve";
    }

$mailClient->Body = '
<div style="background-color: #51816a; padding: 50px; border-radius:10px; margin: auto; width: 500px;" font-family: Arial, sans-serif;">
    <div style="text-align: center;">
        <img style="text-align: center; width: 120px; margin-bottom: 20px;" src="cid:logo_lpb" alt="Logo Petites Bulles">
      </div>
        <h2 style="text-align: center; color: #f0ddc9;">Merci pour votre message !</h2>
        <p style="color: #000000;">Bonjour ' . $prenom . ',</p>
        <p style="color: #000000;">Merci pour votre message ! Nous l\'avons bien reçu :</p>
        <blockquote style="border-left:2px solid #ccc; margin:10px; padding-left:10px;">' . $message . '</blockquote>
        <p style="color: #000000;">Nous vous répondrons dans les plus brefs délais.</p>
        <p style="color: #000000;">À très bientôt,<br><b><p style="text-align:center; color: #f0ddc9;">l\'atelier des petites bulles</b></p></p>
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
?>

