<?php
//class to upload the image of the application
class image
{
    protected $title;
    protected $description;
    protected $size;
    protected $width;
    protected $height;
    protected $name;
    protected $date;
    protected $thumbDir;
    protected $originDir;

    public function __construct($title,$description,$size,$width,$height,$name)
    {
        $this->title=$title;
        $this->description=$description;
        $this->size=$size;
        $this->width=$width;
        $this->height=$height;
        $this->name=$name;
        $this->date=time();
    }
    //setter
    public function setFileName($id){
        $this->name=$id.'_'.$this->name;
    }
    public function setThumbDir($dir){
        $this->thumbDir=$dir;
    }
    public function setOriginDir($dir){
        $this->originDir=$dir;
    }


    //getter
    public function getTitle(){
        return $this->title;
    }
    public function getFileName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getSize(){
        return $this->size;
    }
    public function getWidth(){
        return $this->width;
    }
    public function getHeight(){
        return $this->height;
    }
    public function getDate(){
        return $this->date;
    }
    public function getOriginDir(){
        return $this->originDir;
    }
    public function getThumbDir(){
        return $this->thumbDir;
    }
    //Other methods

    //return the image thumbnail path
    public function thumbImage(){
        return  'storedImages/thumbnails/thumb_'.$this->name;
    }
    // Create thumbnail
    public function create_thumbs(){
        $img_dts = getimagesize($this->originDir.$this->name);
        if($img_dts !== false){
            // Check mime type
            switch($img_dts[2]){
                case IMAGETYPE_JPEG:
                    $img_src = imagecreatefromjpeg($this->originDir.$this->name);
                    break;
            }
        }
        $img_w = $img_dts[0];
        $img_h = $img_dts[1];
        $new_img_w = 150;
        $new_img_h = 150;
        // Scale the image
        $scale_ratio = $img_w / $img_h;
        if(($new_img_w / $new_img_h) > $scale_ratio){
            $new_img_w = $new_img_h * $scale_ratio;
        }else if(($new_img_w / $new_img_h) == $scale_ratio){
            $new_img_w = $new_img_w;
            $new_img_h = $new_img_h;
        }else{
            $new_img_h = $new_img_w / $scale_ratio;
        }
        // Create image
        $new_img = imagecreatetruecolor($new_img_w, $new_img_h);
        imagecopyresampled($new_img, $img_src, 0, 0, 0, 0, $new_img_w, $new_img_h, $img_w, $img_h);
        imagejpeg($new_img, $this->thumbDir.'thumb_'.$this->name, 90);
        imagedestroy($new_img);
        imagedestroy($img_src);
    }

}
