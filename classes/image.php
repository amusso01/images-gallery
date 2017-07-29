<?php
//class to manipulate the image of the application
class image
{
    private $title;
    private $description;
    private $width;
    private $heigth;
    private $name;
    private $date;
    private static $id = 0;

    public function __construct($title,$description,$width,$height,$name)
    {
        self::$id=self::$id+1;
        $this->title=$title;
        $this->description=$description;
        $this->width=$width;
        $this->heigth=$height;
        $this->name=self::$id.'_'.$name;
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
