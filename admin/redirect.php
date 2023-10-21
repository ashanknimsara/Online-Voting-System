<?php
require 'includes/conn.php'; // Database connection code here

if (isset($_SESSION['admin'])) {
    header('location: home.php');
}

require_once 'C:\xampp\htdocs\Online-Voting-System\vendor\autoload.php'; // Include Google API PHP client library

$clientID = '612464270278-3bieqja4d6tki4g285gr0slkcu0803qb.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Online-Voting-System/admin/redirect.php'; // Redirect URI

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');

function redirectToGoogleAuth($client) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}

if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        if ($client->getAccessToken()) {
            $oauth2 = new Google_Service_Oauth2($client);
            $userData = $oauth2->userinfo->get();

            // Check if the user's email exists in your database
            $googleEmail = $userData->email;
            $sql = "SELECT * FROM admin WHERE email = '$googleEmail'";
            $query = $conn->query($sql);

            if ($query->num_rows > 0) {
                session_start();
                $row = $query->fetch_assoc();
                $_SESSION['admin'] = $row['id'];
                header('location: home.php'); // Redirect to the home page
            } else {
                $_SESSION['error'] = 'Google email not registered.';
                header('location: index.php'); // Redirect back to the login page
            }
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Google authentication failed.';
        header('location: index.php');
    }
} else {
    // Display Google account selection when "Login with Google" is clicked
    redirectToGoogleAuth($client);
}
?>
