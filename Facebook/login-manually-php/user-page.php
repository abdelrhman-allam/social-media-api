<?php

session_start();

if (isset($_SESSION["access_token"])) {
    $access_token = $_SESSION["access_token"];
    echo $access_token;
    $user_data = file_get_contents("https://graph.facebook.com/v3.2/me/?fields=picture,name&access_token=$access_token");   
    $user_data = json_decode($user_data);
}
else {
    header("location: /login.php" );
    exit;
}
?>

<html>
    <head>
        <title>User Profile</title>
    </head>
    <body>
        
        <img    src="<?php echo $user_data->picture->data->url ?>" />
        <p><?php echo $user_data->name ?></p>
    </body>
</html>
