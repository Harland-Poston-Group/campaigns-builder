<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['firstname']);
    $last_name = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $enquiry_subject = htmlspecialchars($_POST['enquiry_subject']);
    $message = htmlspecialchars($_POST['description']);

    $to = 'paulo.bernardes@portugalhomes.com';
    $subject = 'New Contact Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/html\r\n";

    $body = "<h2>Contact Form Submission</h2>
             <p><strong>Name:</strong> $first_name</p>
             <p><strong>Name:</strong> $last_name</p>
             <p><strong>Email:</strong> $email</p>
             <p><strong>Enquiry Subject:</strong> $enquiry_subject </p>
             <p><strong>Message:</strong><br>$message</p>";

    if (mail($to, $subject, $body, $headers)) {
        echo 'Email sent successfully!';
    } else {
        echo 'Email sending failed.';
    }
}
