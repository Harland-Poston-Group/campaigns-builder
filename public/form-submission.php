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

if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    echo 'IP address = '.$_SERVER['HTTP_CLIENT_IP'];
}
//if user is from the proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    echo 'IP address = '.$_SERVER['HTTP_X_FORWARDED_FOR'];
}
//if user is from the remote address
else{
    echo 'IP address = '.$_SERVER['REMOTE_ADDR'];
}


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

if( isset($_POST['first_name']) && !empty($_POST['first_name']) ){

    $first_name = $_POST['first_name'];

}elseif ( isset($_POST['firstname']) && !empty($_POST['firstname']) ) {

    $first_name = $_POST['firstname'];

}else{

    $first_name = '';

}

if( isset($_POST['last_name']) && !empty($_POST['last_name']) ){

    $last_name = $_POST['last_name'];

}elseif ( isset($_POST['lastname']) && !empty($_POST['lastname']) ) {

    $last_name = $_POST['lastname'];

}else{

    $last_name = '';

}

if( isset($_POST['phone_number']) && !empty($_POST['phone_number']) ){

    $phone_number = $_POST['phone_number'];

}elseif ( isset($_POST['phone']) && !empty($_POST['phone']) ) {

    $phone_number = $_POST['phone'];

}else{

    $phone_number = '';

}

if( isset($_POST['message']) && !empty($_POST['message']) ){

    $message = $_POST['message'];

}elseif ( isset($_POST['description']) && !empty($_POST['description']) ) {

    $message = $_POST['description'];

}else{

    $message = '';

}

// Collect form data
$data = [
    'first_name' => $first_name ?? 'First name empty',
    'last_name' => $last_name ?? 'Last name empty',
    'email' => $_POST['email'] ?? 'Email empty',
    'phone_number' => $phone_number ?? 'Phone number empty',
    'enquiry_subject' => $_POST['enquiry_subject'] ?? '',
    'message' => $message ?? 'Automatically Generated Message | IV Landing Page',
];

// Prepare data for Dynamics 365
$contactData = [
    "firstname" => $data['first_name'],
    "lastname" => $data['last_name'],
    "emailaddress1" => $data['email'],
    "telephone1" => $data['phone_number'],
    "ans_whatareyoulookingfortext"  => $data['enquiry_subject'],
    // "ans_message" => $data['message'],
    'ans_brand' => 'Investment Visa',
];

// Avoid sending message if it's empty - on duplicate entries, this will delete the previous message submission
// and we do not want this as we'll lose data
if( !empty( $data['message'] ) ){
    $contactData["ans_message"] = $data['message'];
}

// Adding a First Page Seen to the request, this is going to be temporary
if( !empty( $_SERVER['HTTP_REFERER'] ) ){

    $contactData["ans_firstpageseen"] = $_SERVER['HTTP_REFERER'];

}

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

// Function to check if lead/contact exists in Dynamics 365
function checkExistingLead($apiUrl, $accessToken, $email) {
    $http = curl_init();

    // $queryUrl = $apiUrl . "/contacts?" . urlencode("\$filter") . "=emailaddress1 eq '" . urlencode($email) . "'"; // Query to check if contact exists by email
    $queryUrl = $apiUrl . "?\$filter=emailaddress1%20eq%20'".$email."'";

    curl_setopt($http, CURLOPT_URL, $queryUrl);
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
    ]);

    $response = curl_exec($http);
    $error = curl_error($http);
    curl_close($http);

    if ($error) {
        throw new Exception("Curl error: $error");
    }

    $responseData = json_decode($response, true);

    // If the query returns results, return the first lead's ID
    if (isset($responseData['value']) && count($responseData['value']) > 0) {
        return $responseData['value'][0]['leadid']; // Return the 'leadid' (GUID)
    } else {
        return false; // No existing lead found
    }
}

// Function to update an existing lead/contact in Dynamics 365
function updateExistingLead($apiUrl, $accessToken, $leadId, $contactData) {
    $http = curl_init();

    // Ensure the leadId is correctly formatted
    // $leadId = urlencode($leadId); // URL encode the leadId if needed

    // $updateUrl = $apiUrl . "/contacts(" . $contactId . ")"; // Update the specific contact by ID
    $updateUrl = $apiUrl . "(" . $leadId . ")";

    // die("Update URL: " . $updateUrl);

    curl_setopt($http, CURLOPT_URL, $updateUrl);
    curl_setopt($http, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($http, CURLOPT_POSTFIELDS, json_encode($contactData));
    curl_setopt($http, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
        'Prefer: return=representation'
    ]);

    $response = curl_exec($http);
    $error = curl_error($http);
    curl_close($http);

    if ($error) {
        throw new Exception("Curl error: $error");
    }

    return $response;
}

// Main logic
if( !isset($petname) && !empty($first_name) && !empty($last_name) && !empty($phone_number) && !empty($message) ){


    if( $data['enquiry_subject'] !== 'Work Visa' && $data['enquiry_subject'] !== '0' ){

        try {
            $accessToken = getAccessToken($tokenUrl, $clientId, $clientSecret, $resource);

            // Check if the contact/lead already exists
            $existingLead = checkExistingLead($apiUrl, $accessToken, $data['email']);


            if ($existingLead) {
                // Update existing lead
                // die("Lead already exists!");

                // If the request comes true, the ID of the lead is returned
                $lead_id = $existingLead;

                try {
                    $response = updateExistingLead($apiUrl, $accessToken, $lead_id, $contactData);
                    echo "Lead updated successfully. Response: " . $response;
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }

            } else {
                // Create a new lead
                // die("Lead doesn'te xist");
                sendToDynamics365($apiUrl, $accessToken, $contactData);
                // die("New lead created successfully.");
            }
            // sendToDynamics365($apiUrl, $accessToken, $contactData);
            // echo "Data successfully sent to Dynamics 365.";

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }else{

        print_r('Work Visa Submission attempt');
    }

}else{

    // Do nothing as it's a BOT submission
    print_r('illegitimate submission');
    echo '<br>';
    print_r($first_name);
    echo '<br>';
    print_r($last_name);
    echo '<br>';
    print_r($phone_number);
    echo '<br>';
    print_r($message);

}

// Clean up the request handling
$kernel->terminate($request, $response);

?>
