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
    $cleanArray=array();
    $cleanTitle = cleanTitle($_POST['img_title']);
    $cleanDesc = cleanDescription($_POST['img_desc']);
        //if $_POST submitted and $_FILE is set check for error (Title,Description and the file image)
        if ($cleanDesc!==false && $cleanTitle!==false && fileClean($_FILES['jpegfile']['error'])==true && imageCheck(($_FILES['jpegfile']['tmp_name']))){
                $tmpName=$_FILES['jpegfile']['tmp_name'];
                $info=imageInfo($tmpName);
              // Replace non allowed chars in filename
                $fileName = preg_replace('/[^A-Za-z0-9\.\-]/', '', $_FILES['jpegfile']['name']);
                $fileName=pathinfo($fileName,PATHINFO_FILENAME).'.'.$info['extension'];
                $image=new image($cleanTitle,$cleanDesc,$info['width'],$info['heigth'],$fileName);
                var_dump($image);


                $cleanArray=['Title'=>$cleanTitle,'Description'=>$cleanDesc];
                $aside.='';//todo build aside tag when photo check will be ok

              //replace template
                $tmplUpload=str_replace('{{selfPath}}',$self.'?page=upload',$tmplUpload);
                $tmplUpload=str_replace('{{lang[imageTitle]}}',$lang['imageTitle'],$tmplUpload);
                $tmplUpload=str_replace('{{lang[imageDesc]}}',$lang['imageDesc'],$tmplUpload);
                $tmplUpload=str_replace('{{lang[imageType]}}',$lang['imageType'],$tmplUpload);
                $tmplUpload=str_replace('{{lang[upload]}}',$lang['upload'],$tmplUpload);
                $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);
                $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);

        }else {
            if($cleanTitle!==false){//if Title has no error redisplay it
                $tmplUpload=str_replace('{{titleOk}}',$cleanTitle,$tmplUpload);
            }else{
                $aside.='<p>'.$lang["errorTitle"].'</p>'.PHP_EOL;
                $tmplUpload=str_replace('{{titleOk}}','',$tmplUpload);
            }
            if($cleanDesc!==false){//if Description has no error redisplay it
                $tmplUpload=str_replace('{{descOk}}',$cleanDesc,$tmplUpload);
            }else{
                $tmplUpload=str_replace('{{descOk}}','',$tmplUpload);
                $aside.='<p>'.$lang["errorDesc"].'</p>'.PHP_EOL;
            }
            if(($error=isFileUpload($_FILES['jpegfile']['tmp_name'],$_FILES['jpegfile']['error']))!== true){
               if (isset($error[1])){
                   $aside.='<p>'.showError($uploadErrors,$error[1]).'</p>'.PHP_EOL;
               }
               if (isset($error[0])){
                   $aside.='<p>'.$error[0].'</p>'.PHP_EOL;
               }
            }
            if(fileClean($_FILES['jpegfile']['error'])&&!imageCheck($_FILES['jpegfile']['tmp_name'])){
                $aside.='<p>File type not accepted please upload Jpeg or Jpeg2000</p>'.PHP_EOL;
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
    //This is the view to show if $_POST not submitted
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