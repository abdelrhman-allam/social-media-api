<?php

if (!session_id()) {
    session_start();    
}

if (!isset($_SESSION["access_token"])) {
    
    header("location: login.php");
    exit;
}

$token = $_SESSION["access_token"];


$url = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
$url .= "&oauth2_access_token=". $token;


$json = json_decode(file_get_contents($url));
// header("Content-Type: application/json");
 echo "<h3>email</h3>";
 var_dump($json);

$url = "https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))";
$url .= "&oauth2_access_token=". $token;

// echo file_get_contents($url);
 $user = json_decode(file_get_contents($url),true);
echo "<h3>User</h3>";
//var_dump($json);
$image = $user["profilePicture"]["displayImage~"]["elements"][2]["identifiers"][0]["identifier"];
 echo "<img src='".$image."'/>";

$url = "https://api.linkedin.com/v1/people/~?format=json";
$url .= "&oauth2_access_token=". $token;
$user = json_decode(file_get_contents($url),true);

 echo "<p>".$user["firstName"] . " " .  $user["lastName"] ."</p>";