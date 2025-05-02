<?php
// Vérifie si le formulaire a été envoyé
if (isset($_POST['submit'])) {
    // Sécuriser les données du formulaire
    $objet = htmlspecialchars($_POST['nom']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $prefixe = htmlspecialchars($_POST['prefixe']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $mail = htmlspecialchars($_POST['mail']);
    $message = htmlspecialchars($_POST['message']);

    // Adresse email de réception
    $destinataire = 'tonemail@domaine.com'; // <-- Mets ici TON adresse e-mail

    // Sujet du mail
    $sujet = "Formulaire de contact : $objet";

    // Contenu du mail
    $contenu = "Vous avez reçu une nouvelle demande de contact :\n\n";
    $contenu .= "Nom : $nom\n";
    $contenu .= "Prénom : $prenom\n";
    $contenu .= "Téléphone : $prefixe $telephone\n";
    $contenu .= "Email : $mail\n\n";
    $contenu .= "Message :\n$message\n";

    // Entêtes
    $headers = "From: $mail" . "\r\n" .
               "Reply-To: $mail" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Envoi du mail
    if (mail($destinataire, $sujet, $contenu, $headers)) {
        // Redirection ou message de succès
        header("Location: ../view/confirmation.php?message=contact"); 
        exit();
    } else {
        echo "Erreur lors de l'envoi du message. Veuillez réessayer.";
    }
} else {
    echo "Accès non autorisé.";
}
?>
