<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

class MassDelete extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $employeeRepository;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $deleted = 0;

        foreach ($collection as $employee) {
            $this->employeeRepository->deleteById($employee->getId());
            $deleted++;
        }

        $this->messageManager->addSuccessMessage(__('Total of %1 record(s) deleted.', $deleted));
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
