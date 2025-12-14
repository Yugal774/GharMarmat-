<?php     
class pratice{
    public $name, $c;

    function setName(){
        $this-> c= $this->name;
        return $this -> c;
    }

    function getName(){
        echo $this->c;
    }
}

$c1 = new pratice();

$c1 -> name="yugal";
$c1 -> setName();
$c1 -> getName();

?>