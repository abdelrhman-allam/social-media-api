<?php

if (!session_id()) {
    session_start();    
}

?>
<html>
    <head>
        <title></title>
    </head>
    <body>
<a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=78p317wy61fb5y&redirect_uri=http://localhost:8700/callback.php&scope=r_basicprofile r_emailaddress r_liteprofile">Login with Linkedin</a>
    </body>
</html>


