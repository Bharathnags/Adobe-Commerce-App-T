<?php
class Father{
    function money(){
        echo "Father's money";
    }
    function vehicles(){
        echo "Father's vehicles";
    }
}
class Child extends Father{

//child extends fathers properties
}
$obj=new Child();
$obj->money();
$obj->vehicles();

//Inheritance is accepted in php whereas encapsulation and polymorphism is not so for concepts refer java code
