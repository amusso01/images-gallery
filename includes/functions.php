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
        case 'large':
            return 'views/large.php';
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
//Function to execute SELECT query
//@parameter name of the table to select
//@parameter name of the attribute to select default *
//@parameter connection object
//@return the number of row in mysqli::result object for the query
function selectQuery($table,$myDb,$attribute='*'){
    $sql='SELECT '.$attribute.' FROM '.$table;
    $myDb->real_escape_string($sql);
    if($result=$myDb->query($sql)){
        $row=$result->current_field;
    }else{
        return $myDb->error;
    }
    $result->free();
    return $row;
}
//this function check if the file and directory of file to be saved exist
//@parameter directory where to save the file
//@parameter filename pf the temporary file is $_FILE[]['tmp_name']
//@return true if the file and dir exist or an array of error
function dirCheck($dirName,$tmpName){
    if(is_dir($dirName)){
        if (is_file($tmpName)){
            if (is_writable($dirName)){
                return true;
            }else{
                $error=['directory permission negate!!'];
            }
        }else{
            $error=['The image file does not exist!'];
        }
    }else{
        $error=['The directory does not exist!'];
    }
    return $error;
}

//function convert byte to readable language. This function has been adopted from a post on Stack overflow
/***************************************************************************************
 *    Title: PHP filesize MB/KB conversion
 *    Author: Adnan
 *    Date: 31/04/2011
 *    Availability: https://stackoverflow.com/questions/5501427/php-filesize-mb-kb-conversion
 *
 ***************************************************************************************/

function formatSizeUnits($bytes)
{
    if ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}


//Function to read file name in a dir and store it in an array
//@$dirPath the path of the dir to read
//@return path to dir with all the file inside as index of array and id as value
function dirFile($dirPath,$indices=1){
    $imgArray=array();
    if (file_exists($dirPath)){
        $dir=opendir($dirPath);
        while(false!==($file=readdir($dir))){
            if(($file=='.')||($file=='..')){
                continue;
            }else{
                $id=explode('_',$file);
                $imgArray[$dirPath.$file]=$id[$indices];
            }
        }
        closedir($dir);
        return $imgArray;
    }else{
        return false;
    }
}
//@parameter id of the image
//@parameter $url of the api service
//cURL function to @return the json result of the call or false in case of error
function apiCall($id,$url){
    $handle=curl_init();
    $finalUrl=$url.'?id='.$id;
    $flag=true;
    curl_setopt($handle,CURLOPT_URL,$finalUrl);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($handle);
    if(curl_errno($handle)) {
        $flag=false;
    }
    curl_close($handle);
    if(!$flag){
        return false;
    }
    return $result;
}

//parameter the php self path
//return the absolute path without the last file in this case index.php
function jsonPath($path){
    $base=explode('/',$path);
    unset($base[count($base)-1]);
    $urlString='';
    foreach ($base as $key=> $value){
        if ($key==0){
            $urlString.=$value;
        }else{
            $urlString.='/'.$value;
        }
    }
    return $_SERVER['HTTP_HOST'].$urlString;
}
// Resize image
//@parameter origin's path of the file image
//@parameter destination path of the resized image
//@parameter name of the file with the id ex id_imageName
//@return the final path of the resized image
function resizeImage($originPath, $destinationPath,$imageName){
    $img_dts = getimagesize($originPath.$imageName);
    if($img_dts !== false){
        switch($img_dts[2]){
            case IMAGETYPE_JPEG:
                $img_src = imagecreatefromjpeg($originPath.$imageName);
                break;
        }
    }
    $img_w = $img_dts[0];
    $img_h = $img_dts[1];
    $new_img_w = 600;
    $new_img_h = 600;
    // Scale image
    $scale_ratio = $img_w / $img_h;
    if($img_w >= 600 && $img_h >= 600){
        if(($new_img_w / $new_img_h) > $scale_ratio){
            $new_img_w = $new_img_h * $scale_ratio;
        }else if(($new_img_w / $new_img_h) == $scale_ratio){
            $new_img_w = $new_img_w;
            $new_img_h = $new_img_h;
        }else{
            $new_img_h = $new_img_w / $scale_ratio;
        }
    }else{
        $new_img_w = $img_w;
        $new_img_h = $img_h;
    }
    // Create image
    $new_img = imagecreatetruecolor($new_img_w, $new_img_h);
    imagecopyresampled($new_img, $img_src, 0, 0, 0, 0, $new_img_w, $new_img_h, $img_w, $img_h);
    imagejpeg($new_img, $destinationPath.'r_'.$imageName, 90);
    imagedestroy($new_img);
    imagedestroy($img_src);
    return $destinationPath.'r_'.$imageName;
}



//function autoloader to load the classes
function myAutoloader($className){
    include 'classes/'.$className.'.php';
}
//Register the function with php
spl_autoload_register('myAutoloader');
