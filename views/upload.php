<?php
//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file= $TEMPLATE_URL.'upload.html';
$tmplUpload=file_get_contents($file);

//make navigation bar
$nav=makeNav();

//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_upload'],$tmplHead);
$tmplUpload=str_replace('{{selfPath}}',$self,$tmplUpload);
$tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
$tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
$tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
$tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);


//echo html
echo $tmplHead;
echo $tmplUpload;