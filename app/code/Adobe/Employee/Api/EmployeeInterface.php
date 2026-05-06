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
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get Joining Date
     *
     * @return string|null
     */
    public function getJoiningDate();

    /**
     * Get Designation
     *
     * @return string|null
     */
    public function getDesignation();

    /**
     * Get Address
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Get Status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Get Hobbies
     *
     * @return string[]|null
     */
    public function getHobbies();

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Set Joining Date
     *
     * @param string $joiningDate
     * @return $this
     */
    public function setJoiningDate($joiningDate);

    /**
     * Set Designation
     *
     * @param string $designation
     * @return $this
     */
    public function setDesignation($designation);

    /**
     * Set Address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * Set Status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set Hobbies
     *
     * @param string[] $hobbies
     * @return $this
     */
    public function setHobbies($hobbies);
}
