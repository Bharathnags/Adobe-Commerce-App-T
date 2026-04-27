<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Block\Account;

use Magento\Framework\View\Element\Template;

/**
 * Class Form
 *
 * Handles employee form data for create/edit operations.
 */
class Form extends Template
{
    /**
     * @var mixed
     */
    protected $employee;

    /**
     * Set employee data
     *
     * @param mixed $employee
     * @return void
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get employee data
     *
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->employee;
    }
}