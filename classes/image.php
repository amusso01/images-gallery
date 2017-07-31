<?php
//class to upload the image of the application
class image
{
    protected $title;
    protected $description;
    protected $width;
    protected $heigth;
    protected $name;
    protected $date;

    public function __construct($title,$description,$width,$height,$name)
    {

        $this->title=$title;
        $this->description=$description;
        $this->width=$width;
        $this->heigth=$height;
        $this->name=$name;
        $this->date=time();
    }
    //setter

    //getter
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
}
