<?php
//simple class 
class myClass {
    /**
     *  color string public attribute
    **/
	 
    public $color = null;
	 
    public function echoMe()
    { 
        $this->setColor('verde olivo');
	     
        echo ' color is ' . $this->color; 
    } 
	 
    private function setColor($color)
    {
	    $this->color = $color;
    }
} 
//create object
$mine = new myClass(); 
$mine->echoMe(); 
?> 
