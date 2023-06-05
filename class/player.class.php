<?php
class Player{
    private String $name;
    private String $marker;

    public function __construct(String $name, String $marker){
        $this->name = $name;
        $this->marker = $marker;
    }
    public function getName(){
        return $this->name;
    }

    public function getMarker(){
        return $this->marker;
    }

}
?>