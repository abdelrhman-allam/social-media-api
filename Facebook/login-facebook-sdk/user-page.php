<?php
// TODO: https://developers.facebook.com/docs/graph-api/reference/user/picture/

if(!session_id()) {
    session_start();
}


if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
require_once 'config.php';

$fb_app_id = FB_APP_ID;
$fb_app_secret = FB_APP_SECRET;
$fb_redirect_url = FB_REDIRECT_URL;

/*
 * 
 * @author abdelrahman
 *
 */

if (isset($_SESSION['fb_access_token']) && !empty($_SESSION['fb_access_token'])) {
    echo "Hello User";    
    echo '<h3>Access Token</h3>';
    echo $_SESSION['fb_access_token'];
    

    $fb = new Facebook\Facebook([
      'app_id' => $fb_app_id,
      'app_secret' => $fb_app_secret,
      'default_graph_version' => 'v2.10',
      ]);

    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->get('/me?fields=id,name', $_SESSION['fb_access_token']);
      
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    
    

$user = $response->getGraphUser();
echo '<h3>User Node</h3>';
var_dump($user);



    try {
      // Returns a `FacebookFacebookResponse` object
      $response = $fb->get(
        $user['id'].'/picture?redirect=0&type=large',
        $_SESSION['fb_access_token']
      );
    } catch(FacebookExceptionsFacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(FacebookExceptionsFacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    $graphNode = $response->getGraphNode();
    echo '<h3>Graph Node</h3>';
    var_dump($graphNode);
    
    echo '<h3>Data</h3>';
    echo '<img src="'. $graphNode['url'] .'"/>' ;
    echo 'Name: ' . $user['name'];
}
else {
    // not autorized user 
    header("location: /login.php");
}

