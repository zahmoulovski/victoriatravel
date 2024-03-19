<?php

// Initialize variables to hold form data and error message
$name = $email = $message = '';
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Set up recipient email address
    $to = 'contact@santiago.tn'; // Change this to your recipient email address

    // Prepare email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Répondre à: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email using mail() function
    if (mail($to, 'Santiago - Nouveau formulaire de contact', "Nom: $name\nEmail: $email\nMessage: $message", $headers)) {
        // Email sent successfully
        $successMessage = 'Le message a été envoyé';
    } else {
        // Failed to send email
        $errorMessage = `Échec de l'envoi du message`;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <!-- Add your CSS styles here -->
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<?php if (!empty($successMessage)) { ?>
    <p class="success"><?php echo $successMessage; ?></p>
    <p>Redirection vers la page d'accueil...</p>
    <meta http-equiv="refresh" content="5;url=/index.html"> <!-- Redirect to home page after 5 seconds -->
<?php } elseif (!empty($errorMessage)) { ?>
    <p class="error"><?php echo $errorMessage; ?></p>
<?php } else { ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"><?php echo $message; ?></textarea><br>
        <button type="submit">Envoyer</button>
    </form>
<?php } ?>

</body>
</html>
