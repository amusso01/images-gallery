<?php
// Set a document root URL. May be useful depending how URLs are served.
$FILE_ROOT = 'C:/wamp64/www/phpMysqlFma/FMA/';

// Set the media URL (where the media files will be...css, storedImages, js etc)
$MEDIA_URL = 'media/';

// Set the template directory URL (useful if directory structure changes)
$TEMPLATE_URL = $FILE_ROOT.'templates/';

//path to images thumbnail
$THUMB_URL=$FILE_ROOT.'storedImages/thumbnails';
//path to original images
$ORIGINAL_URL=$FILE_ROOT.'storedImages/original';

//path of file
$self = htmlentities($_SERVER['PHP_SELF']);


//general setting
date_default_timezone_set('Europe/London');
$config['lang']='en';
//thumbnail dimension
define('THUMBNAIL_WIDTH', 150);
define('THUMBNAIL_HEIGHT', 150);



// database settings
$config['db_user'] = 'root';
$config['db_pass'] = '';
$config['db_host'] = 'localhost';
$config['db_name'] = 'fmaw1';