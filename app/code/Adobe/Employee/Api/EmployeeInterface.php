<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Api;

/**
 * Interface EmployeeInterface
 *
 * Defines the data structure for Employee entity.
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

    /**
     * Get ID
     */
    public function getId();

    /**
     * Get Name
     */
    public function getName();

    /**
     * Get Joining Date
     */
    public function getJoiningDate();

    /**
     * Get Designation
     */
    public function getDesignation();

    /**
     * Get Address
     */
    public function getAddress();

    /**
     * Get Status
     */
    public function getStatus();

    /**
     * Get Hobbies
     */
    public function getHobbies();

    /**
     * Set ID
     *
     * @param mixed $id
     */
    public function setId($id);

    /**
     * Set Name
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Set Joining Date
     *
     * @param mixed $joiningDate
     */
    public function setJoiningDate($joiningDate);

    /**
     * Set Designation
     *
     * @param string $designation
     */
    public function setDesignation($designation);

    /**
     * Set Address
     *
     * @param string $address
     */
    public function setAddress($address);

    /**
     * Set Status
     *
     * @param mixed $status
     */
    public function setStatus($status);

    /**
     * Set Hobbies
     *
     * @param mixed $hobbies
     */
    public function setHobbies($hobbies);
}