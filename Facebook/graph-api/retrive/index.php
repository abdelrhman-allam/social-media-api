<?php

/*
 * 
 * @author abdelrahman
 *
 */


require_once 'config.php';

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
        // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    //FB post content
    $message = 'Test message from google.com website';
    $title = 'Post From localhost';
    $link = 'http://www.google.com/';
    $description = 'Localhost is a programming by me.';
    $picture = 'https://www.sciencedaily.com/images/2018/08/180828204911_1_540x360.jpg';
            
    $attachment = array(
        'message' => $message,
        'name' => $title,
        'link' => $link,
        'description' => $description,
        'picture'=>$picture,
    );
    
    try{
        
        // Post to Facebook
       // $fb->post('/me/feed', $attachment, $accessToken);
        // Display post submission status
        // echo 'The post was published successfully to the Facebook timeline.';
        $res = $fb->get('/me/albums?fields=likes,picture', $accessToken);
           
        header('Content-Type: application/json');
        
        echo json_encode($res->getDecodedBody());
       //  echo $accessToken;
       // echo $fb->getUser();
    }catch(FacebookResponseException $e){
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    }catch(FacebookSDKException $e){
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}else{
    // Get Facebook login URL
    $fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    // Redirect to Facebook login page
    echo '<a href="' . $fbLoginURL . '">Log in with Facebook!</a>';

}