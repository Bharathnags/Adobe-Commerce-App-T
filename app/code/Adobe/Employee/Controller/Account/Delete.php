<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends Action
{
    protected $employeeRepository;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam('id');

        if (!$id) {
            $this->messageManager->addErrorMessage(__('Invalid employee ID.'));
            return $resultRedirect->setPath('employee/account/index');
        }

        try {
            $this->employeeRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('Employee deleted successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('employee/account/index');
    }
}
