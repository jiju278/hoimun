<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection and email injection
    $nom = htmlspecialchars($_POST["nom"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $objet = htmlspecialchars($_POST["objet"]);
    $message = htmlspecialchars($_POST["message"]);
    $spamCheck = empty($_POST["remark"]);

    // Perform additional checks as needed

    // Example: Send email to the site administrator
    if ($spamCheck) {
        $to = "admin@mail.com";
        $subject = "Nouveau message de formulaire de contact";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        $emailBody = "Nom: $nom\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Objet: $objet\n\n";
        $emailBody .= "Message:\n$message";

        mail($to, $subject, $emailBody, $headers);

        // Optionally, redirect the user to a thank you page
        header("Location: thank_you.html");
        exit;
    } else {
        // Handle spam submission
        // Optionally, redirect the user to an error page
        header("Location: error.html");
        exit;
    }
}
?>