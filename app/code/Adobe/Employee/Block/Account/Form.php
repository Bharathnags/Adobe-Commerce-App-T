<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Block\Account;

use Magento\Framework\View\Element\Template;

class Form extends Template
{
    protected $employee;

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    public function getEmployee()
    {
        return $this->employee;
    }
}