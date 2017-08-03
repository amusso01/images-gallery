<?php
// Require necessary files
require 'includes/config.php';
include  'includes/functions.php';

//instantiate the myDb class and GET the views to display
require  'includes/dbConnect.php';

//get method request
$method=$_SERVER['REQUEST_METHOD'];

//check if is a GET request
if ($method=='GET'){
    //check the $_GET array is not empty
    if (!empty($_GET)){
        //check id is set an not empty in the array
        if (isset($_GET['id'])&&!empty($_GET['id'])){
            $id=$_GET['id'];

            //escape the id request prevent SQL injection
            $mysqli->real_escape_string($id);
            //prepare the sql request
            $sql="SELECT * FROM `imagegallery`";
            if ($id!=='all'){
                $sql.=" WHERE id=$id";
            }
            //execute statement
           $result=$mysqli->query($sql);
            if($result!==false){
                //check if there is a result num_row return 0 if nothing has being found or 1 in case of success
                if($result->num_rows==1){
                    $row=$result->fetch_assoc();
                    header('Content-type: application/json');
                    echo json_encode($row);
                    $result->free();
                    $mysqli->close();
                }else{
                    http_response_code(404);
                    die('This id is not in the database');
                }
            }else{
                http_response_code(404);
                die($mysqli->error);
            }
        }else{
            http_response_code(404);
            die('id is not given in the request');
        }
    }else{
        http_response_code(404);
        die('$_GET method not set');
    }
}else{
    http_response_code(404);
    die('HTTP request method not supported! Only support GET request');
}

