<?php
    include("user.php");
    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {
        case 'GET':
            
            $user = new User();
            
            // logout user
            $result = $user->logout();
            
            echo "Logout successful. See you next time!";

            break;
        
        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>