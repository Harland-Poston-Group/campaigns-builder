<?php

// File to handle the form submission and create the lead within Dynamics

// Include Composer's autoload file
require '../vendor/autoload.php';

// Include Laravel's application bootstrap file
// require '../bootstrap/app.php';

// Create the Laravel application instance
$app = require_once '../bootstrap/app.php';

// Initialize Laravel's Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);


// Configuration
$apiUrl = getenv('DYNAMICS_API_URL'); // Replace with your API URL
$tokenUrl = getenv('DYNAMICS_TOKEN_URL'); // Replace with your token URL
$clientId = getenv('DYNAMICS_CLIENT_ID'); // Replace with your client ID
$clientSecret = getenv('DYNAMICS_CLIENT_SECRET'); // Replace with your client secret
$resource = getenv('DYNAMICS_RESOURCE'); // Replace with your resource URL

if( isset($_POST['petname']) && !empty($_POST['petname']) ){
    $petname = $_POST['petname'];
}


// echo '<pre>';
// print_r($apiUrl);
// echo '<br>';
// print_r($tokenUrl);
// echo '<br>';
// print_r($clientId);
// echo '<br>';
// print_r($clientSecret);
// echo '<br>';
// print_r($resource);
// echo '</pre>';

// die('hey');

// Collect form data
$data = [
    'first_name' => $_POST['first_name'] ?? 'First name empty',
    'last_name' => $_POST['last_name'] ?? 'Last name empty',
    'email' => $_POST['email'] ?? 'Email empty',
    'phone_number' => $_POST['phone_number'] ?? 'Phone number empty',
    'enquiry_subject' => $_POST['enquiry_subject'] ?? '',
    'message' => $_POST['message'] ?? '',
];

// Prepare data for Dynamics 365
$contactData = [
    "firstname" => $data['first_name'],
    "lastname" => $data['last_name'],
    "emailaddress1" => $data['email'],
    "telephone1" => $data['phone_number'],
    "ans_whatareyoulookingfortext"  => $data['enquiry_subject'],
    "ans_message" => $data['message'],
];

// Function to get access token
function getAccessToken($tokenUrl, $clientId, $clientSecret, $resource) {
    $http = curl_init();

    curl_setopt($http, CURLOPT_URL, $tokenUrl);
    curl_setopt($http, CURLOPT_POST, true);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'client_credentials',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'resource' => $resource,
    ]));
    curl_setopt($http, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);

    $response = curl_exec($http);
    $error = curl_error($http);

    curl_close($http);

    if ($error) {
        throw new Exception("Curl error: $error");
    }

    $body = json_decode($response);

    if (isset($body->access_token)) {
        return $body->access_token;
    } else {
        throw new Exception("Failed to retrieve access token: " . print_r($body, true));
    }
}

// Function to send data to Dynamics 365
function sendToDynamics365($apiUrl, $accessToken, $contactData) {
    $http = curl_init();

    curl_setopt($http, CURLOPT_URL, $apiUrl);
    curl_setopt($http, CURLOPT_POST, true);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_POSTFIELDS, json_encode($contactData));
    curl_setopt($http, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
    ]);

    $response = curl_exec($http);
    $httpCode = curl_getinfo($http, CURLINFO_HTTP_CODE);
    $error = curl_error($http);

    curl_close($http);

    if ($error) {
        throw new Exception("Curl error: $error");
    }

    if ($httpCode !== 204) {
        throw new Exception("Failed to send data to Dynamics 365: " . $response);
    }

    return $response;
}

// Main logic
if( !isset($petname) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || $_POST['phone_number'] ){

    if( $data['enquiry_subject'] !== 'Work Visa' && $data['enquiry_subject'] !== '0' ){

        try {
            $accessToken = getAccessToken($tokenUrl, $clientId, $clientSecret, $resource);
            sendToDynamics365($apiUrl, $accessToken, $contactData);
            echo "Data successfully sent to Dynamics 365.";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }else{

        print_r('Work Visa Submission attempt');
    }

}else{

    // Do nothing as it's a BOT submission
    print_r('illegitimate submission');
}

// Clean up the request handling
$kernel->terminate($request, $response);

?>
