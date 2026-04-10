<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Api;

interface EmployeeRepositoryInterface
{
    public function save($employee);
    public function getById($id);
    public function deleteById($id);
}