<?php

if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
require_once 'config.php';

$fb_app_id = FB_APP_ID;
$fb_app_secret = FB_APP_SECRET;
$fb_redirect_url = FB_REDIRECT_URL;

$fb = new Facebook\Facebook([
  'app_id' => $fb_app_id,
  'app_secret' => $fb_app_secret,
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$loginUrl = $helper->getLoginUrl($fb_redirect_url);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';