<?php

//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file=$TEMPLATE_URL.'home.html';
$tmplHome=file_get_contents($file);
$file=$TEMPLATE_URL.'thumbnails.html';
$tmplThumb=file_get_contents($file);

//make navigation bar
$nav=makeNav();

var_dump($self);

$imageArray=dirFile($config['pathThumb']);
foreach ($imageArray as $key=>$value){

}


//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{lang[nav]}}',$lang['nav'],$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_home'],$tmplHead);
$tmplHome=str_replace('{{article}}',$tmplThumb,$tmplHome);

//echo html
echo $tmplHead;
echo $tmplHome;