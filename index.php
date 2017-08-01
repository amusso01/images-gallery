<?php
// Require necessary files
require_once'includes/config.php';
include_once 'includes/functions.php';

//instantiate the myDb class and GET the views to display
require_once 'includes/dbConnect.php';

//GET the views from url
$view=getUrl();

//language
require_once 'lang/'.$config['lang'].'.php';

// Include the head
include('includes/head.php');

//check if $_POST exist and display the view accordingly
//if (isSubmited()){
//    $cleanTitle=cleanTitle($_POST['img_title']);
//    $cleanDesc=cleanDescription($_POST['img_desc']);
//    if ($cleanTitle!==false){
//        if ($cleanDesc!==false){
//
//        }else{
//
//        }
//    }else{
//
//    }
//    include 'views/upload.php';
//}else{
//    //check which views to display
//    include url($view);
//}

include url($view);



include 'includes/footer.php';

$mysqli->close();