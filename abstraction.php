<?php
abstract class Mobile
{
    abstract function SimMeasures();

    function greeting()
    {
        echo "Welcome to Greeting";
    }}


//$obj = new Mobile();//cannot create object for abstract class
//$obj->greeting();

class Airtel extends Mobile{
    function SimMeasures(){
        echo "Welcome to Airtel";
    }
}
$obj=new Airtel();
$obj->SimMeasures();
$obj->greeting();
