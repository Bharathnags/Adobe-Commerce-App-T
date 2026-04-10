<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $resource;
    protected $factory;

    public function __construct(
        \Adobe\Employee\Model\ResourceModel\Employee $resource,
        \Adobe\Employee\Model\EmployeeFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
    }

    public function save($employee)
    {
        try {
            $this->resource->save($employee);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save Employee: %1', $e->getMessage()));
        }
        return $employee;
    }

    public function getById($id)
    {
        $emp = $this->factory->create();
        $this->resource->load($emp, $id);
        if (!$emp->getId()) {
            throw new NoSuchEntityException(__('Employee with ID "%1" does not exist', $id));
        }
        return $emp;
    }

    public function deleteById($id)
    {
        try {
            $emp = $this->getById($id);
            $this->resource->delete($emp);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete Employee: %1', $e->getMessage()));
        }
    }
}