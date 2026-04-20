<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Model\EmployeeFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Adobe_Employee::employee';

    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * @var EmployeeFactory
     */
    protected $employeeFactory;

    /**
     * @param Context $context
     * @param EmployeeRepositoryInterface $employeeRepository
     * @param EmployeeFactory $employeeFactory
     */
    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->employeeFactory = $employeeFactory;
    }

    /**
     * Save employee action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        $id = !empty($data['id']) ? (int)$data['id'] : null;

        try {
            if ($id) {
                $employee = $this->employeeRepository->getById($id);
            } else {
                $employee = $this->employeeFactory->create();
            }

            $employee->setName($data['name'] ?? '');
            $employee->setJoiningDate($data['joining_date'] ?? null);
            $employee->setDesignation($data['designation'] ?? '');
            $employee->setAddress($data['address'] ?? '');
            $employee->setStatus(isset($data['status']) ? (int)$data['status'] : 1);
            $employee->setHobbies($data['hobbies'] ?? '');

            $this->employeeRepository->save($employee);
            $this->messageManager->addSuccessMessage(__('Employee saved successfully.'));

        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            if ($id) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the employee.')
            );
            if ($id) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
