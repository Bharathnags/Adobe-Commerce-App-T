<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Adobe\Employee\Model\Publisher;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Mass Status Controller
 */
class MassStatus extends Action
{
    /**
     * Authorization level
     */
    const ADMIN_RESOURCE = 'Adobe_Employee::employee';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param Publisher $publisher
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Publisher $publisher
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->publisher = $publisher;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection(
                $this->collectionFactory->create()
            );

            $employeeIds = $collection->getAllIds();
            $status = (int) $this->getRequest()->getParam('status');

            if (!$employeeIds) {
                $this->messageManager->addErrorMessage(
                    __('Please select employees.')
                );

                return $this->_redirect('*/*/index');
            }

            $message = json_encode([
                'employee_ids' => $employeeIds,
                'status'       => $status
            ]);

            $this->publisher->publish($message);

            $this->messageManager->addSuccessMessage(
                __('Employee status queued successfully.')
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __($e->getMessage())
            );
        }

        return $this->_redirect('*/*/index');
    }
}