<?php
require_once '../vendor/autoload.php';

// Include the database connection details
include 'includes/conn.php';

// init configuration
$clientID = '612464270278-ptt4bh9ekc16c23fad8sc1dhf5jrrluo.apps.googleusercontent.com'; // Replace with your Google OAuth client ID
$clientSecret = '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'; // Replace with your Google OAuth client secret
$redirectUri = 'http://localhost/Online-Voting-System/admin/redirect.php'; // Replace with your redirect URI

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get the user's email from Google
    $googleEmail = $client->verifyIdToken($token['id_token'])['email'];

    // Check if the email exists in the "admin" table
    $query = "SELECT * FROM admin WHERE email = '$googleEmail'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email exists in the "admin" table, redirect to your desired page
        header('location: home.php');
    } 
} else {
    // Email does not exist in the "admin" table
    echo "Email not found in the database.";
}
?>