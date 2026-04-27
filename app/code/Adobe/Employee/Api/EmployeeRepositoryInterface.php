<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Api;

/**
 * Interface EmployeeRepositoryInterface
 *
 * Repository contract for Employee entity operations.
 */
interface EmployeeRepositoryInterface
{
    /**
     * Save employee entity
     *
     * @param mixed $employee
     * @return mixed
     */
    public function save($employee);

    /**
     * Get employee by ID
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Delete employee by ID
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById($id);
}