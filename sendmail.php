<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i dati inviati dal form (con sanificazione base)
    $fname = strip_tags(trim($_POST["fname"]));
    $lname = strip_tags(trim($_POST["lname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $comment = trim($_POST["comment"]);

    // Controlla dati essenziali
    if ( empty($fname) || empty($lname) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($comment) ) {
        // Dati non validi, torna indietro o mostra errore
        echo "Per favore compila tutti i campi correttamente.";
        exit;
    }

    // Imposta destinatario (tuo indirizzo email)
    $to = "nicoloparacchini@gmail.com";  // Sostituisci con la tua mail vera

    // Oggetto della mail
    $subject = "Nuovo messaggio dal sito di Monolith";

    // Corpo del messaggio
    $message = "Nome: $fname $lname\n";
    $message .= "Email: $email\n\n";
    $message .= "Messaggio:\n$comment\n";

    // Intestazioni mail
    $headers = "From: $fname $lname <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Invia mail
    if (mail($to, $subject, $message, $headers)) {
        echo "Grazie per avermi contattato, ti risponderò al più presto.";
    } else {
        echo "Errore nell'invio del messaggio, riprova più tardi.";
    }
} else {
    // Se non è un POST, non fa niente
    echo "Accesso non autorizzato.";
}
?>