<?php
//retrieve file template
$file= $TEMPLATE_URL.'header.html';
$tmplHead=file_get_contents($file);
$file= $TEMPLATE_URL.'upload.html';
$tmplUpload=file_get_contents($file);

//make navigation bar
$nav=makeNav();

//replace header template
$tmplHead=str_replace('{{navigation}}',$nav,$tmplHead);
$tmplHead=str_replace('{{lang[nav]}}',$lang['nav'],$tmplHead);
$tmplHead=str_replace('{{date}}',$lang['date'],$tmplHead);
$tmplHead=str_replace('{{lang[title]}}',$lang['title_upload'],$tmplHead);
//Check if the $_POST exist
if (isSubmited()) {
    $aside='<aside>';
    $error=false;
    $sql=array();
    $cleanTitle = cleanTitle($_POST['img_title']);
    $cleanDesc = cleanDescription($_POST['img_desc']);
    var_dump();
    if (is_null($cleanTitle) || is_null($cleanDesc)) {
      $sql=['Title'=>$cleanTitle,'Description'=>$cleanDesc];
      var_dump($sql);
    }else {
        if($cleanTitle){
            $tmplUpload=str_replace('{{titleOk}}',$cleanTitle,$tmplUpload);
        }
        if($cleanDesc){
            $tmplUpload=str_replace('{{descOk}}',$cleanDesc,$tmplUpload);
        }
        $error=true;
    }
}else{
    //replace template
    $tmplUpload=str_replace('{{selfPath}}',$self.'?page=upload',$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);

    $tmplUpload=str_replace('{{aside}}','',$tmplUpload);
    $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);
    $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);
}





//echo html
echo $tmplHead;
echo $tmplUpload;