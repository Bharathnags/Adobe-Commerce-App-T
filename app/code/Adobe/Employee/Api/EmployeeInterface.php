<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Api;

/**
 * Summary of EmployeeInterface
 */
interface EmployeeInterface
{
  
    const ID = 'id';
    const NAME = 'name';
    const JOINING_DATE = 'joining_date';
    const DESIGNATION = 'designation';
    const ADDRESS = 'address';
    const STATUS = 'status';
    const HOBBIES = 'hobbies';
   
    public function getId();
    public function getName();
    public function getJoiningDate();
    public function getDesignation();
    public function getAddress();
    public function getStatus();
    public function getHobbies();

    
    public function setId($id);
    public function setName($name);
    public function setJoiningDate($joiningDate);
    public function setDesignation($designation);
    public function setAddress($address);
    public function setStatus($status);
    public function setHobbies($hobbies);
}
