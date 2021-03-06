<?php

//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file=$TEMPLATE_URL.'home.html';
$tmplHome=file_get_contents($file);


//make navigation bar
$nav=makeNav();

$imageArray=dirFile($config['pathThumb']);//array of image path

$jsonUrl=jsonPath($self).'/api.php';//api url

$imageHtml='';//Html to replace {{article}} in the template
if (is_array($imageArray)){
    foreach ($imageArray as $key=>$value){
        $json=apiCall($value,$jsonUrl);
        $jsonDecode=json_decode($json);
        $file=$TEMPLATE_URL.'thumbnails.html';
        $tmplThumb=file_get_contents($file);
        if (!is_object($jsonDecode)){
            $tmplThumb=str_replace('{{thumbnailPath}}',$key,$tmplThumb);
            $tmplThumb=str_replace('{{title}}',"<p class='error'>$json</p>",$tmplThumb);
            $tmplThumb=str_replace('{{id}}','broken&picture='.$value,$tmplThumb);
            $imageHtml.=$tmplThumb;
        }else{
            $tmplThumb=str_replace('{{thumbnailPath}}',htmlspecialchars($key),$tmplThumb);
            $tmplThumb=str_replace('{{title}}',htmlspecialchars($jsonDecode->title),$tmplThumb);
            $tmplThumb=str_replace('{{id}}',htmlspecialchars($jsonDecode->id),$tmplThumb);
            $imageHtml.=$tmplThumb;
        }
    }
}else{
    $imageHtml.='<p>THE DIRECTORY OF THE THUMBNAIL IMAGE DOES NOT EXIST  OR IS CORRUPTED</p>';
}

//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{lang[nav]}}',$lang['nav'],$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_home'],$tmplHead);
$tmplHome=str_replace('{{article}}',$imageHtml,$tmplHome);

//echo html
echo $tmplHead;
echo $tmplHome;


