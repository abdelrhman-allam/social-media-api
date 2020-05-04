<?php

if (!session_id()) {
    session_start();
}


if ($_GET['code']) {
    
    
    $code = $_GET['code'];
    $curl = curl_init();
    
    $auth_url = "https://www.linkedin.com/oauth/v2/accessToken";
    $params = "grant_type=authorization_code";
    $params .= "&code=".$code;
    $params .= "&redirect_uri=http://localhost:8700/callback.php";
    $params .= "&client_id=";
    $params .= "&client_secret=";
    
          curl_setopt($ch, CURLOPT_POST, 1);


    curl_setopt_array($curl, array(
        CURLOPT_URL => $auth_url,
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => 1, 
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Content-Type: application/x-www-form-urlencoded"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
       
}

if ($err) {
    echo "error:";
    var_dump($err);
}

  $response = json_decode($response,true);
  
  if (isset($response["access_token"])) {
    $_SESSION["access_token"] = (string) $response["access_token"];
    header("location: profile.php");
   
  }
  
