<?php
//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file=$TEMPLATE_URL.'large.html';
$tmplLarge=file_get_contents($file);
$file=$TEMPLATE_URL.'imageInfo.html';
$tmplInfo=file_get_contents($file);

//make navigation bar
$nav=makeNav();


$html='';//html to replace in the template
$found=false;//flag. We search if the resized image exist, if is not we will create one

//check if id is set in the Get request and record it accordingly
//in case  GET id is not set or not numeric redirect to 404 page
if (isset($_GET['picture'])&&$_GET['id']=='broken'){
    $id=$_GET['picture'];
    $tmplLarge=str_replace('{{title}}','',$tmplLarge);
    $tmplLarge=str_replace('{{aside}}',$lang['errorNoDb'],$tmplLarge);
//    $html.='<p>'.$tmplLarge.'</p>'.PHP_EOL;
    $originArray=dirFile($config['pathOriginal'],0);//array of original path
    foreach ($originArray as $key=> $value) {
        if($id==$value){
            $imagePath=$key;
            $imgName=explode('/',$imagePath);
            break;
        }
    }

}elseif (is_numeric($_GET['id'])){
    $id=$_GET['id'];
    $jsonUrl=jsonPath($self).'/api.php';//api url
    $json=apiCall($id,$jsonUrl);
    $jsonDecode=json_decode($json);
    if (is_object($jsonDecode)){
        $imgName=$jsonDecode->id.'_'.$jsonDecode->filename;//name of the image in the original folder
        $tmplLarge=str_replace('{{title}}',$jsonDecode->title,$tmplLarge);
        $tmplInfo=str_replace('{{langDesc}}',$lang['desc'],$tmplInfo);
        $tmplInfo=str_replace('{{description}}',htmlspecialchars($jsonDecode->description),$tmplInfo);
        $tmplInfo=str_replace('{{langDate}}',$lang['uploaded'],$tmplInfo);
        $tmplInfo=str_replace('{{date}}',date('d-m-Y H:i:s',htmlspecialchars($jsonDecode->date)),$tmplInfo);
        $tmplInfo=str_replace('{{langSize}}',$lang['size'],$tmplInfo);
        $tmplInfo=str_replace('{{size}}',formatSizeUnits(htmlspecialchars($jsonDecode->size)),$tmplInfo);
        $tmplInfo=str_replace('{{langDownload}}',$lang['download'],$tmplInfo);
        $tmplInfo=str_replace('{{originalPath}}',$config['pathOriginal'].htmlspecialchars($jsonDecode->id).'_'.htmlspecialchars($jsonDecode->filename),$tmplInfo);
        $html.=$tmplInfo;
    }else{
        $tmplLarge=str_replace('{{title}}',$json,$tmplLarge);
        $tmplInfo=str_replace('{{langDesc}}','',$tmplInfo);
        $tmplInfo=str_replace('{{description}}','',$tmplInfo);
        $tmplInfo=str_replace('{{langDate}}','',$tmplInfo);
        $tmplInfo=str_replace('{{date}}','',$tmplInfo);
        $tmplInfo=str_replace('{{langSize}}','',$tmplInfo);
        $tmplInfo=str_replace('{{size}}','',$tmplInfo);
        $tmplInfo=str_replace('{{langDownload}}','',$tmplInfo);
        $tmplInfo=str_replace('{{originalPath}}','',$tmplInfo);
        $html.=$tmplInfo;
    }
}else{
    header( 'Location: '.$self.'?page=404' ) ;
    die();
}

$resizedArray=dirFile($config['pathResized']);//array of resized image path


//check if the resized image exist
foreach ($resizedArray as $key=>$value){
    if ($id==$value){
        $found=true;
        $imagePath=$key;
        break;
    }
}

if (!$found&& isset($_GET['picture'])){//if image resized does not exist create one and display it
    $resizedPath=resizeImage($config['pathOriginal'],$config['pathResized'],$imgName[2]);
    $tmplLarge=str_replace('{{resizedImage}}',$resizedPath,$tmplLarge);
}elseif(!$found && is_numeric($_GET['id'])){
    $resizedPath=resizeImage($config['pathOriginal'],$config['pathResized'],$imgName);
    $tmplLarge=str_replace('{{resizedImage}}',$resizedPath,$tmplLarge);
}else{
    $tmplLarge=str_replace('{{resizedImage}}',$imagePath,$tmplLarge);
}


//replace template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{lang[nav]}}',$lang['nav'],$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_home'],$tmplHead);
$tmplLarge=str_replace('{{aside}}',$html,$tmplLarge);



//echo html
echo $tmplHead;
echo $tmplLarge;


