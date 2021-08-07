<?php
    header('Content-Type: application/json');
    include("user.php");    

    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {
        case 'POST':
            
            $user = new User();
            // attempt to login user
            $result = $user->login($_POST["username"], $_POST["password"]);
            
            // trigger an error if not logged in successfully
            if($result == []) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Incorrect username or password';
            }

            echo json_encode($result);

            break;
        
        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>