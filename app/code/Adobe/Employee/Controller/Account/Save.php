<?php
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Model\EmployeeFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action
{
    protected $employeeRepository;
    protected $employeeFactory;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        EmployeeFactory $employeeFactory,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->employeeFactory = $employeeFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->messageManager->addErrorMessage(__('No data to save.'));
            return $resultRedirect->setPath('employee/account/index');
        }

        try {
            // Load existing or create new
            $employee = isset($data['id']) && $data['id'] ?
                $this->employeeRepository->getById((int)$data['id']) :
                $this->employeeFactory->create();

            // Convert hobbies array to comma-separated string
            $hobbies = isset($data['hobbies']) && is_array($data['hobbies'])
                ? implode(', ', $data['hobbies'])
                : null;

            // Set data
            $employee->setName($data['name']);
            $employee->setJoiningDate($data['joining_date'] ?? null);
            $employee->setDesignation($data['designation'] ?? null);
            $employee->setAddress($data['address'] ?? null);
            $employee->setStatus($data['status'] ?? 1);
            $employee->setHobbies($hobbies);

            // Save
            $this->employeeRepository->save($employee);
            $this->messageManager->addSuccessMessage(__('Employee saved successfully.'));

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not save employee: %1', $e->getMessage()));
        }

        return $resultRedirect->setPath('employee/account/index');
    }
}
