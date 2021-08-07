<?php
    header('Content-Type: application/json');
    include("user.php");
    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {
        case 'GET':
            
            $user = new User();

            // logout user
            $result = $user->logout();
            
            $response = array(
                "data" => [],
                "message" => "Success"
            );

            echo json_encode($response);

            break;
        
        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>