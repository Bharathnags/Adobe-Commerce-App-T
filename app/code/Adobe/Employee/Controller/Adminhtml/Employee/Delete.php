<?php
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

class Delete extends Action
{
    protected $employeeRepository;

    public function __construct(
        Action\Context $context,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $this->employeeRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Employee deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
