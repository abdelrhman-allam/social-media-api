<?php
/*
 * 
 * @author abdelrahman
 *
 */


error_reporting(E_ALL);

include_once 'config.php';

$fb_app_id = FB_APP_ID;
$fb_redirect_url = FB_REDIRECT_URL;
$fb_app_secret = FB_APP_SECRET;

session_start();


if($_SESSION["access_token"]){
    header('Location: /user-page.php');
}
if (isset($_GET['code'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://graph.facebook.com/v3.2/oauth/access_token?client_id=$fb_app_id&client_secret=$fb_app_secret&code={$_GET['code']}&redirect_uri={$fb_redirect_url}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      // echo $response;
       $response = json_decode($response);
       $access_token = $response->access_token;
       
       
       // header('Content-Type: application/json');
       // echo $user_data;    
       $_SESSION['access_token'] = $access_token;
       header('Location: /user-page.php');
    }

}

