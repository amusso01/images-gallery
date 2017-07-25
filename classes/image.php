<?php
//class to manipulate the image of the application
class image
{
    private $title;
    private $description;
    private $time;
    private static $id = 0;

    public function __construct($title,$description,$time)
    {
        $this->title=$title;
        $this->description=$description;
        $this->time=$time;
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
