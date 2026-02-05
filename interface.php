<?php
interface Mobile
{
    public function SimMeasures();

    public function greeting();
}

    class Airtel implements Mobile{

        function SimMeasures(){
            echo "SimMeasures taken by airtel";
        }
        function  greeting(){
            echo "Greeting";

}
    }
    $obj = new Airtel();
$obj->SimMeasures();
$obj->greeting();


