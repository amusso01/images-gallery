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
    $error=array();
    $sql=array();
    $cleanTitle = cleanTitle($_POST['img_title']);
    $cleanDesc = cleanDescription($_POST['img_desc']);
    if ($cleanDesc!==false && $cleanTitle!==false && (isImageFile($_FILES['jpegfile']['tmp_name'],$_FILES['jpegfile']['error']))==false) {
      $sql=['Title'=>$cleanTitle,'Description'=>$cleanDesc];

      $aside.='';//todo build aside tag when photo check will be ok

      var_dump($sql);
      //replace template
        $tmplUpload=str_replace('{{selfPath}}',$self.'?page=upload',$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);
        $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);
        $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);
    }else {
        if($cleanTitle!==false){
            $tmplUpload=str_replace('{{titleOk}}',$cleanTitle,$tmplUpload);
        }else{
            $aside.='<p>'.$lang["errorTitle"].'</p>'.PHP_EOL;
            $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);

        }
        if($cleanDesc!==false){
            $tmplUpload=str_replace('{{descOk}}',$cleanDesc,$tmplUpload);
        }else{
            $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);
            $aside.='<p>'.$lang["errorDesc"].'</p>'.PHP_EOL;
        }
        if(($error=isImageFile($_FILES['jpegfile']['tmp_name'],$_FILES['jpegfile']['error']))!== true){
           if (isset($error[1])){
               $aside.='<p>'.showError($uploadErrors,$error[1]).'</p>';
           }
           if (isset($error[0])){
               $aside.='<p>'.$error[0].'</p>';
           }
        }
        $aside.='</aside>';
        //replace template
        $tmplUpload=str_replace('{{selfPath}}',$self.'?page=upload',$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
        $tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);
        $tmplUpload=str_replace('{{uploadSize}}',$uploadSize,$tmplUpload);
        $tmplUpload=str_replace('{{aside}}',$aside,$tmplUpload);
        $tmplUpload=str_replace('{{invalidUpload}}',$lang['invalidUpload'],$tmplUpload);
    }
}else{
    //replace template
    $tmplUpload=str_replace('{{selfPath}}',$self.'?page=upload',$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
    $tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);
    $tmplUpload=str_replace('{{uploadSize}}',$uploadSize,$tmplUpload);

    $tmplUpload=str_replace('{{aside}}','',$tmplUpload);
    $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);
    $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);
}





//echo html
echo $tmplHead;
echo $tmplUpload;