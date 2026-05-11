<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Model\Consumer;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Employee Status Consumer
 */
class EmployeeStatusConsumer
{
    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        LoggerInterface $logger
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->logger = $logger;
    }

    /**
     * Process queue message
     *
     * @param string $message
     * @return void
     */
    public function process($message)
    {
        try {
            $data = json_decode($message, true);

            if (empty($data['employee_ids'])) {
                return;
            }

            foreach ($data['employee_ids'] as $employeeId) {
                $employee = $this->employeeRepository->getById($employeeId);
                $employee->setStatus((int) $data['status']);
                $this->employeeRepository->save($employee);
            }

            $this->logger->info(
                'Employee status updated successfully.'
            );
        } catch (\Exception $e) {
            $this->logger->error(
                'Consumer Error: ' . $e->getMessage()
            );
        }
    }
}