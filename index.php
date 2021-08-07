<?php
    error_reporting(E_ERROR | E_PARSE);
    header('Content-Type: application/json');

    include("user.php");
    include("todo.php");

    $user = new User();
    $todo = new Todo();

    // get the currently logged in user
    $currentUser = $user->getCurrentUser();
    
    // trigger an error if no logged in user
    if($currentUser == null) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 403 Forbidden');
        echo "No logged in user";

        return false;
    }

    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method) {
        case 'GET':
            $result = [];

            if($_GET == []) {   // Retrieve todos of current user
                $result = $todo->getAllTodo($currentUser["id"]);

            } else {    // Retrieve specific todo
                if(isset($_GET["id"])) {
                    $result = $todo->getTodo($currentUser["id"], $_GET["id"]);
                }
            }

            $response = array(
                "data" => $result,
                "message" => "Success"
            );

            echo json_encode($response);
            
            break;
        case 'POST':
            if($_POST != []) {
                // Create todo
                $result = $todo->createTodo($_POST["todo"], $currentUser["id"]);

                $response = array(
                    "data" => $result,
                    "message" => "Success"
                );

                echo json_encode($response);
            }  

            break;
        case 'PATCH':
            if($_GET != []) {
                // Update todo
                $result = $todo->updateTodo($_GET["id"], $_GET["todo"], $currentUser["id"]);

                $response = array(
                    "data" => $result,
                    "message" => "Success"
                );

                echo json_encode($response);
            }

            break;
        case 'DELETE':
            if($_GET != []) {
                // Delete todo
                $result = $todo->deleteTodo($currentUser["id"], $_GET["id"]);

                $response = array(
                    "data" => $result,
                    "message" => "Success"
                );

                echo json_encode($response);
                
            }

            break;
        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>