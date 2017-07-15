<?php
//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file= $TEMPLATE_URL.'404.html';
$tmpl404=file_get_contents($file);

//make navigation bar
$nav=makeNav();

//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_404'],$tmplHead);
$tmpl404=str_replace('{{lang[404]}}',$lang['404'],$tmpl404);

//echo html
echo $tmplHead;
echo $tmpl404;