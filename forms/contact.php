<?php
// Use your real receiving email address
$receiving_email_address = 'contact@ccidesigns.co.in';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);
  
    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare the email content
    $email_subject = "Contact Form Submission: " . $subject;
    $email_body = "You have received a new message from the contact form:\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message\n";

    // Set the headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
        echo 'Your message has been sent. Thank you!';
    } else {
        echo 'There was an error sending your message. Please try again later.';
    }
}

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}
?>
