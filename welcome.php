<?php

class Welcome {
    public $name = "bbn";
    public $place = "blore";

    function greet() {
        echo "Welcome to " . $this->name . " from " . $this->place;
    }
}

$obj = new Welcome();
$obj->greet();

?>
