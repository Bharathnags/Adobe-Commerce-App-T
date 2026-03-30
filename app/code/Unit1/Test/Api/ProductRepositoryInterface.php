<?php
namespace Unit1\Test\Api;

interface ProductRepositoryInterface
{
    public function getById($id);
}
//so basically ur getting ur dependency from other class.If u use extend keyword entire functions tends to appear which is not required or where specific functions are required
//which tends to increase the size of app build.So in constructor we write only required files/depends which is required from other class
//in di.xml preference is given to the file required other than the one taken from core module
