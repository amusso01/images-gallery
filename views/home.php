<?php

//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file=$TEMPLATE_URL.'home.html';
$tmplHome=file_get_contents($file);

$nav=makeNav();

//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_home'],$tmplHead);

//echo html
echo $tmplHead;
echo $tmplHome;