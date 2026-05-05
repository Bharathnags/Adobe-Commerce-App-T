<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Controller\Ajax;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * Class Update
 *
 * Updates existing employee data via API request.
 */
class Update implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepository;

    /**
     * Update constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(
        JsonFactory $jsonFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Execute method
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $result = $this->jsonFactory->create();

        try {
            $data = json_decode(file_get_contents("php://input"), true);

            if (!$data || !isset($data['id'])) {
                throw new \Exception("Invalid request data");
            }

            $employee = $this->employeeRepository->getById((int)$data['id']);

            $employee->setName($data['name'] ?? '');
            $employee->setJoiningDate($data['joining_date'] ?? null);
            $employee->setDesignation($data['designation'] ?? null);
            $employee->setAddress($data['address'] ?? null);
            $employee->setStatus($data['status'] ?? 1);

            $employee->setHobbies(
                isset($data['hobbies']) ? implode(',', $data['hobbies']) : ''
            );

            $this->employeeRepository->save($employee);

            return $result->setData([
                'success' => true,
                'employee' => $employee->getData()
            ]);

        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}