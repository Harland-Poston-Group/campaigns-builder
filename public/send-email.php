<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data

    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
    $enquiry_subject = htmlspecialchars($_POST['enquiry_subject'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['messagee'], ENT_QUOTES, 'UTF-8');
    $petname = htmlspecialchars($_POST['petname'], ENT_QUOTES, 'UTF-8');

    if (!empty($petname)) {
        die('Spam detected.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address.');
    }

// Sanitize email header inputs
    $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $email);

    // Collect additional data (referrer and location details)
    $referrer = isset($_POST['referrer']) ? htmlspecialchars($_POST['referrer']) : 'Unknown';
    $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : 'Unknown';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : 'Unknown';
    $region = isset($_POST['region']) ? htmlspecialchars($_POST['region']) : 'Unknown';
    $timezone = isset($_POST['timezone']) ? htmlspecialchars($_POST['timezone']) : 'Unknown';
    $ip = isset($_POST['IP']) ? htmlspecialchars($_POST['IP']) : 'Unknown';

    // Prepare email headers and subject
    $to = 'paulo.bernardes@portugalhomes.com';
    $subject = 'New Contact Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/html\r\n";

    // Prepare the email body including the referrer and location data
    $body = "<h2>Investment Visa US Campaign</h2>
             <p><strong>First Name:</strong> $first_name</p>
             <p><strong>Last Name:</strong> $last_name</p>
             <p><strong>Email:</strong> $email</p>
             <p><strong>Phone Number:</strong> $phone_number</p>
             <p><strong>Enquiry Subject:</strong> $enquiry_subject </p>
             <p><strong>Message:</strong><br>$message</p>
             <hr>
             <h3>Visitor Information</h3>
             <p><strong>Referrer:</strong> $referrer</p>
             <p><strong>Country:</strong> $country</p>
             <p><strong>City:</strong> $city</p>
             <p><strong>Region:</strong> $region</p>
             <p><strong>Time Zone:</strong> $timezone</p>
             <p><strong>IP:</strong> $ip</p>";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo 'Email sent successfully! We will contact you soon.';
    } else {
        echo 'Email sending failed.';
    }
}

/*
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

    $body = "<h2>Investment Visa US Campaign</h2>
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
*/
