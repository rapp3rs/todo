<?php
    Class Todo {
        private $todo;
        private $index;

        function __construct() {
            $arrTodo = file('todo.txt');
            $this->todo = $arrTodo;

            $arrTodoIndex = file('todo_index.txt');
            $this->index = $arrTodoIndex[0];
        }
        
        function getAllTodo($userId) {
            $cntToDo = count($this->todo);
            $result = [];

            for($i = 0; $i < $cntToDo; $i++) {
                $tmpTodo = explode(",", trim($this->todo[$i]));

                if($tmpTodo["2"] == $userId) {
                    array_push($result, $tmpTodo);
                }
            }

            return $result;
        }

        function getTodo($userId, $id) {
            $cntToDo = count($this->todo);
            $result = [];

            for($i = 0; $i < $cntToDo; $i++) {
                $tmpTodo = explode(",", trim($this->todo[$i]));

                if($tmpTodo["0"] == $id && 
                    $tmpTodo["2"] == $userId) {
                    $result = $tmpTodo;

                    break;
                }
            }

            return $result;
        }

        function createTodo($todo, $userId) {
            $currIndex = intval($this->index) + 1;

            $data = [$currIndex, $todo, $userId];

            // $data = $currIndex.",".$todo.",".$userId.PHP_EOL;

            // write to the todo file
            $todoFile = fopen("todo.txt", "a");
            fwrite($todoFile, implode(",", $data).PHP_EOL);
            fclose($todoFile);

            // update index
            $indexFile = fopen("todo_index.txt", "w") or die("Unable to open file!");
            fwrite($indexFile, $currIndex);
            fclose($indexFile);

            return $data;
        }

        function deleteTodo($userId, $id) {
            $cntToDo = count($this->todo);
            $isDeleted = false;
            $newFileContent = "";

            for($i = 0; $i < $cntToDo; $i++) {
                $tmpTodo = explode(",", trim($this->todo[$i]));

                if($tmpTodo["0"] != $id || 
                    $tmpTodo["2"] != $userId) {

                    $newFileContent .= $this->todo[$i];
                } else {
                    $isDeleted = true;
                }
            }

            // write to the todo file
            $todoFile = fopen("todo.txt", "w");
            fwrite($todoFile, $newFileContent);
            fclose($todoFile);

            return $isDeleted;
        }

        function updateTodo($id, $todo, $userId) {
            $cntToDo = count($this->todo);
            $newFileContent = "";
            $data = [];

            for($i = 0; $i < $cntToDo; $i++) {
                $tmpTodo = explode(",", trim($this->todo[$i]));

                if(trim($tmpTodo["0"]) == $id && 
                    trim($tmpTodo["2"]) == $userId) {

                    $data = [$id, $todo, $userId];

                    $newFileContent .= implode(",", $data).PHP_EOL;

                } else {
                    $newFileContent .= $this->todo[$i];
                }
            }
            
            // write to the todo file
            $todoFile = fopen("todo.txt", "w");
            fwrite($todoFile, $newFileContent);
            fclose($todoFile);

            return $data;
        }
    }
?>