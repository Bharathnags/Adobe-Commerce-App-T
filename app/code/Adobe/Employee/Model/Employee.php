<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model;

use Magento\Framework\Model\AbstractModel;
use Adobe\Employee\Api\EmployeeInterface;

class Employee extends AbstractModel implements EmployeeInterface
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(\Adobe\Employee\Model\ResourceModel\Employee::class);
    }

    // ------------------------------
    // Getter methods
    // ------------------------------

    public function getId()
    {
        return $this->getData('id');
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function getJoiningDate()
    {
        return $this->getData('joining_date');
    }

    public function getDesignation()
    {
        return $this->getData('designation');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }

    public function getStatus()
    {
        return $this->getData('status');
    }

    public function getHobbies()
    {
        return $this->getData('hobbies');
    }

    // ------------------------------
    // Setter methods
    // ------------------------------

    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    public function setJoiningDate($joiningDate)
    {
        return $this->setData('joining_date', $joiningDate);
    }

    public function setDesignation($designation)
    {
        return $this->setData('designation', $designation);
    }

    public function setAddress($address)
    {
        return $this->setData('address', $address);
    }

    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    public function setHobbies($hobbies)
    {
        return $this->setData('hobbies', $hobbies);
    }
}