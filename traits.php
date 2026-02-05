<?php
trait A{
    public  function Car(){
        echo "You have a car";
    }
}

trait B{
    public  function Bike(){
        echo "You have a bike";
    }
}

class c {
    use A,B;
}
$obj=new c();
$obj->Car();
$obj->Bike();