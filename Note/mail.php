<?php
$to = "recipient@example.com";
$subject = "Test mail";
$message = "This is a test email.";
$headers = "From: sender@example.com";
mail($to, $subject, $message, $headers);
echo "Mail sent successfully";
?>
