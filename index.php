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


include url($view);



include 'includes/footer.php';

$mysqli->close();