<?php

//305/Polyclinic/php/sendEmail.php
// Send an email to Admin
$toEmail = "dutton-gillespie.keny@student.greenriver.edu";
$fromName = "Suggestion Box";
$fromEmail = "suggestionbox@onyxdex.com";
$subject = "New Suggestion was Submitted";
$headers = "From: $fromName <$fromEmail>";

$message = "A new suggestion has been placed.\n";
$message = $message . "Name: $name\n";
$message .= "Email: $email\n";
$message .= "Suggestion: $sugg\n";

$success = mail($toEmail, $subject, $message, $headers);

if (!$success) {
    echo "<p>There was a problem placing your order. Please call us at (444) 333-4532";
}
