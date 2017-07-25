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
//check form field for completion
function cleanDescription($description)
{
    $description = trim($description);
    if (!empty($description)) {
        if (strlen($description) > 250) {
            $cleanDesc = strtolower($description);
            $cleanDesc = ucfirst($cleanDesc);
            return $cleanDesc;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function cleanTitle($title){
    $title=trim($title);
    if (!empty($title)){
        if (strlen($title)>50){
            $cleanTitle=strtolower($title);
            $cleanTitle=ucfirst($cleanTitle);
            return $cleanTitle;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

//function autoloader to load the classes
function myAutoloader($className){
    include 'classes/'.$className.'.php';
}
//Register the function with php
spl_autoload_register('myAutoloader');
