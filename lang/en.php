<?php
$lang['title_home']='Building Web Applications with MySQL and PHP - BBK - amusso01 FMA';
$lang['title_upload']='Upload Images';
$lang['title_image']='Large Image';
$lang['title_404']='Page not found';
$lang['date']=makeDate($config);
$lang['404']='404 We are sorry but we cannot find the page requested! ';
$lang['imageTitle']='Picture Title';
$lang['imageDesc']='Picture Description';
$lang['imageType']='Please select Jpeg/Jpg file';
$lang['upload']='Upload picture';
$lang['nav']='Upload';
$lang['file']='Choose File';
$lang['errorTitle']="The Title is missing or is too long!(50 chracters allowed)";
$lang['errorDesc']="The Description is missing or is too long!(250 characters allowed)";
$uploadSize=ini_get("upload_max_filesize");
$lang['invalidUpoad']='Uploading File Failed, Permission Denied!';
$uploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

