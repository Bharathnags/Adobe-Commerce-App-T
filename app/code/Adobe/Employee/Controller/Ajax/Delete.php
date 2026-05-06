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
 * Class Delete
 *
 * Deletes an employee record via API request.
 */
class Delete implements HttpPostActionInterface
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
     * Delete constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param EmployeeRepositoryInterface $repository
     */
    public function __construct(
        JsonFactory $jsonFactory,
        EmployeeRepositoryInterface $repository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->repository = $repository;
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

            if (!isset($data['id'])) {
                throw new \Exception("ID missing");
            }

            $this->repository->deleteById($data['id']);

            return $result->setData([
                'success' => true
            ]);

        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
