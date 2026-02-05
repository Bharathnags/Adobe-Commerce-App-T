<?php
class Sample{
    function greet(){
        echo"Hello nags";
    }
    function welcome(){
        echo "Hello World";
    }
    function __construct(){
        echo "Constructor automatically called during object creation";
    }
    function __destruct(){
        echo " Destructor automatically called after class execution is completed";
    }}

    $obj=new Sample();
   $obj->greet();
   $obj->welcome();

