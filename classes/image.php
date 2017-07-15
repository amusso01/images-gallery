<?php
//class to manipulate the image of the application
class image
{
    private $title;
    private $description;


    public function __construct($title)
    {

    }
    //setter
    public function setTitle($title){
        $this->title=$title;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    //getter
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
}
