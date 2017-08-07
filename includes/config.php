<?php
// Set a document root URL. May be useful depending how URLs are served.
$FILE_ROOT = '';

// Set the media URL (where the media files will be...css, storedImages, js etc)
$MEDIA_URL = 'media/';

// Set the template directory URL (useful if directory structure changes)
$TEMPLATE_URL = $FILE_ROOT.'templates/';

//path of file
$self = htmlentities($_SERVER['PHP_SELF']);


//url of the Json web service

//$jsonService=

//general setting
date_default_timezone_set('Europe/London');
$config['lang']='en';


$config['thumbPrefix']='thumb_';
$config['pathThumb']=$FILE_ROOT.'storedImages/thumbnails/';
$config['pathOriginal']=$FILE_ROOT.'storedImages/original/';
$config['pathResized']=$FILE_ROOT.'storedImages/resized/';



// database settings
$config['db_user'] = '';
$config['db_pass'] = '';
$config['db_host'] = '';
$config['db_name'] = '';

$sqlInsert='INSERT INTO imagegallery (filename,description,title,size,width,height,date) ';
