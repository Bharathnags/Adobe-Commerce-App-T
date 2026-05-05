<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Controller\Ajax;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Model\EmployeeFactory;

/**
 * Class Save
 *
 * Creates or updates employee data via API request.
 */
class Save implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var EmployeeRepositoryInterface
     */
    private $repository;

    /**
     * @var EmployeeFactory
     */
    private $factory;

    /**
     * Save constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param EmployeeRepositoryInterface $repository
     * @param EmployeeFactory $factory
     */
    public function __construct(
        JsonFactory $jsonFactory,
        EmployeeRepositoryInterface $repository,
        EmployeeFactory $factory
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->repository = $repository;
        $this->factory = $factory;
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

            if (!$data) {
                throw new \Exception("Invalid data");
            }

            if (!empty($data['id'])) {
                $employee = $this->repository->getById($data['id']);
            } else {
                $employee = $this->factory->create();
            }

            $employee->setName($data['name'] ?? '');
            $employee->setJoiningDate($data['joining_date'] ?? null);
            $employee->setDesignation($data['designation'] ?? '');
            $employee->setAddress($data['address'] ?? '');
            $employee->setStatus($data['status'] ?? 1);
            $employee->setHobbies(
                isset($data['hobbies']) ? implode(',', $data['hobbies']) : ''
            );

            $this->repository->save($employee);

            return $result->setData([
                'success' => true,
                'item' => $employee->getData()
            ]);

        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}