<?php
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Edit Employee') : __('New Employee')
        );

        return $resultPage;
    }
}