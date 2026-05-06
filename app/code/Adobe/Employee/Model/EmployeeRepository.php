<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Model;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var \Adobe\Employee\Model\ResourceModel\Employee
     */
    protected $resource;

    /**
     * @var \Adobe\Employee\Model\EmployeeFactory
     */
    protected $factory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @param \Adobe\Employee\Model\ResourceModel\Employee $resource
     * @param \Adobe\Employee\Model\EmployeeFactory $factory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \Adobe\Employee\Model\ResourceModel\Employee $resource,
        \Adobe\Employee\Model\EmployeeFactory $factory,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save employee
     *
     * @param mixed $employee
     * @return mixed
     * @throws CouldNotSaveException
     */
    public function save($employee)
    {
        try {
            $this->resource->save($employee);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save Employee: %1', $e->getMessage())
            );
        }

        return $employee;
    }

    /**
     * Get employee by id
     *
     * @param int $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $emp = $this->factory->create();
        $this->resource->load($emp, $id);

        if (!$emp->getId()) {
            throw new NoSuchEntityException(
                __('Employee with ID "%1" does not exist', $id)
            );
        }

        return $emp;
    }

    /**
     * Delete employee by id
     *
     * @param int $id
     * @return void
     * @throws CouldNotDeleteException
     */
    public function deleteById($id)
    {
        try {
            $emp = $this->getById($id);
            $this->resource->delete($emp);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(
                __('Could not delete Employee: %1', $e->getMessage())
            );
        }
    }

    /**
     * Get employee list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ) {
        $collection = $this->collectionFactory->create();

        $items = [];

        foreach ($collection as $employee) {
            $items[] = [
                'id'          => $employee->getId(),
                'name'        => $employee->getName(),
                'designation' => $employee->getDesignation(),
                'address'     => $employee->getAddress(),
                'status'      => $employee->getStatus(),
                'hobbies'     => $employee->getHobbies()
            ];
        }

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);

        return $searchResults;
    }
}
