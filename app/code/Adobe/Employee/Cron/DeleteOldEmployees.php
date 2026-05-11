<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Cron;

use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Delete employees older than 3 days
 */
class DeleteOldEmployees
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param CollectionFactory $collectionFactory
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        EmployeeRepositoryInterface $employeeRepository,
        LoggerInterface $logger
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->employeeRepository = $employeeRepository;
        $this->logger = $logger;
    }

    /**
     * Execute cron
     *
     * @return void
     */
    public function execute()
    {
        try {
            $collection = $this->collectionFactory->create();

            $collection->addFieldToFilter(
                'created_at',
                ['lt' => date('Y-m-d H:i:s', strtotime('-3 minutes'))]
            );

            foreach ($collection as $employee) {
                $this->employeeRepository->deleteById($employee->getId());
            }

            $this->logger->info(
                'Adobe Employee Cron: Old employees deleted successfully.'
            );
        } catch (\Exception $e) {
            $this->logger->error(
                'Adobe Employee Cron Error: ' . $e->getMessage()
            );
        }
    }
}
