<?php

//check views to display
//@return views to display
function getUrl(){
    if (!isset($_GET['page'])){
        $view='home';
    }else {
        $view = $_GET['page'];
    }
    return $view;
}
//@$id the name of the views to render
//@return the url to includes in index.php
function url($id){
    switch ($id) {
        case 'home':
            return 'views/home.php';
            break;
        case 'upload':
            return 'views/upload.php';
            break;
        default:
            return 'views/404.php';
            break;
    }
}
//return date according to the language
//@param $config
//@return string
function makeDate($config){
    $today=getdate();
    if ($config['lang']=='it'){
        switch ($today['weekday']){
            case 'Monday':
                $today['weekday']='Lunedi';
                break;
            case 'Tuesday':
                $today['weekday']='Martedi';
                break;
            case 'Wednesday':
                $today['weekday']='Mercoledi';
                break;
            case 'Thursday':
                $today['weekday']='Giovedi';
                break;
            case 'Friday':
                $today['weekday']='Venerdi';
                break;
            case 'Saturday':
                $today['weekday']='Sabato';
                break;
            case 'Sunday':
                $today['weekday']='Domenica';
                break;
        }
        switch ($today['month']){
            case 'January':
                $today['month']='Gennaio';
                break;
            case 'February':
                $today['month']='Febbraio';
                break;
            case 'March':
                $today['month']='Marzo';
                break;
            case 'April':
                $today['month']='Aprile';
                break;
            case 'May':
                $today['month']='Maggio';
                break;
            case 'June':
                $today['month']='Giugno';
                break;
            case 'July':
                $today['month']='Luglio';
                break;
            case 'August':
                $today['month']='Agosto';
                break;
            case 'September':
                $today['month']='Settembre';
                break;
            case 'October':
                $today['month']='Ottobre';
                break;
            case 'November':
                $today['month']='Novembre';
                break;
            case 'December':
                $today['month']='Dicembre';
                break;
        }

    }
    return $today['weekday'].' '.$today['mday'].' '.$today['month'].' '.$today['year'];
}

//navigation bar
function makeNav(){
    return '<li><a href="index.php?page=upload">{{lang[nav]}}</a></li>';
}

//check if the $POST array has been created
function isSubmited(){
    if (isset($_POST['submit'])){
        return true;
    }
    return false;
}
//check form description for error
function cleanDescription($description)
{
    $cleanDesc = trim($description);
    if ($cleanDesc!=='') {
        if (strlen($cleanDesc) <250) {
            $cleanDesc = strtolower($cleanDesc);
            $cleanDesc = ucfirst($cleanDesc);
            return $cleanDesc;
        }
    }
    return false;
}
//check form title for error
function cleanTitle($title){
    $cleanTitle=trim($title);
    if ($cleanTitle!==''){
        if (strlen($cleanTitle)<50){
            $cleanTitle=strtolower($cleanTitle);
            $cleanTitle=ucfirst($cleanTitle);
            return $cleanTitle;
        }
    }
    return false;
}
//====All the following functions are used to check the file image for error====

//Check the mime type of the file
//Only Jpeg allowed
//For future implementation of type just add case to the switch statment
function imageCheck($fileName){
    $details=getimagesize($fileName);
    if($details!==false){
        switch ($details[2]){
            case IMAGETYPE_JPEG:
                return true;
                break;
            case IMAGETYPE_JPEG2000:
                return true;
                break;
            default:
                return false;
        }
    }
}
//parameter temporary file name from $_FILE array and error code again from $_FILE array
//return true if valid or array of error to be converted in the template replace process
function isFileUpload($file, $errorCode)
{
    $error = array();
    $valid = true;
    if (!is_uploaded_file($file)) {
        $valid = false;
        $error = [0=>'{{invalidUpload}}'];
        if ($errorCode !== 0) {
            $valid = false;
            $error=[1=>$errorCode];
        }
    }
    if(!$valid){
        return $error;
    }
    return true;
}
function fileClean($error){
    if ($error==0){
        return true;
    }
    return false;
}
//=================================================================================
//return array of some usefull informations of an image
function imageInfo($fileName){
    $info=array();
    $image=getimagesize($fileName);
    $info=[
        'width'=>$image[0],
        'heigth'=>$image[1],
        'extension'=>$image['mime']
    ];
    $extension=explode('/',$info['extension']);
    $info['extension']=$extension[1];
    return $info;
}

//This function is used to show the error in the $error array output of isFileUpload
function showError($errorArray,$errorNumber){
    foreach ($errorArray as $key => $value){
        if ($errorNumber==$key)
        {
            return $value;
        }
    }
}

//function autoloader to load the classes
function myAutoloader($className){
    include 'classes/'.$className.'.php';
}
//Register the function with php
spl_autoload_register('myAutoloader');
