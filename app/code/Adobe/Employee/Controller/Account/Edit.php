<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Edit extends Action
{
    protected $employeeRepository;
    protected $resultPageFactory;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        PageFactory $resultPageFactory,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$id) {
            $this->messageManager->addErrorMessage(__('Invalid employee ID.'));
            return $resultRedirect->setPath('employee/account/index');
        }

        try {
            $employee = $this->employeeRepository->getById($id);
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getLayout()->getBlock('employee.form')->setEmployee($employee);
            return $resultPage;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('employee/account/index');
        }
    }
}
