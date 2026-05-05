<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;  
use Magento\Framework\Api\SearchResultsInterface;


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
     * @param \Adobe\Employee\Api\EmployeeInterface $employee
     * @return \Adobe\Employee\Api\EmployeeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Adobe\Employee\Api\EmployeeInterface $employee);

    /**
     * Get employee by ID
     *
     * @param int $id
     * @return \Adobe\Employee\Api\EmployeeInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * Delete employee by ID
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($id);


/**
     * Retrieve employee list.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );
}