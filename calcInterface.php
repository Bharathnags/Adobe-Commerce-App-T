<?php
interface Calculator{
    public function Addition();
    public function Subtraction();
    public function Multiplication();
    public function Division();
}

class Operation implements Calculator{
    public function Addition(){
        echo "Addition operation";
    }
    public function Subtraction(){
        echo "Subtraction operation";
    }
    public function Multiplication(){
        echo "Multiplication operation";
    }
    public function Division(){
        echo "Division operation";
    }
}
$obj= new Operation();
$obj->Addition();
$obj->Subtraction();
$obj->Multiplication();
$obj->Division();