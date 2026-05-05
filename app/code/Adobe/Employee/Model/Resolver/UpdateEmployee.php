<?php

namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\GraphQlInputException;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

class UpdateEmployee implements ResolverInterface
{
    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Update employee
     */
    public function resolve(
        $field,
        $context,
        ResolveInfo $info,
       ?array $value = null,
       ?array $args = null
    ) {
        // ✅ Validate required input
        if (empty($args['id'])) {
            throw new GraphQlInputException(__('Employee ID is required'));
        }

        try {
            $employee = $this->employeeRepository->getById($args['id']);
        } catch (\Exception $e) {
            throw new GraphQlInputException(__('Employee not found'));
        }

        //  Update fields if provided
        if (isset($args['name'])) {
            $employee->setName($args['name']);
        }

        if (isset($args['designation'])) {
            $employee->setDesignation($args['designation']);
        }

        if (isset($args['address'])) {
            $employee->setAddress($args['address']);
        }

        if (isset($args['status'])) {
            $employee->setStatus($args['status']);
        }

        if (isset($args['hobbies'])) {
            $employee->setHobbies(implode(',', $args['hobbies']));   
        }

        //  Save updated employee
        $this->employeeRepository->save($employee);

        // Return updated data
        return [
            'id' => (int)$employee->getId(),
            'name' => $employee->getName(),
            'designation' => $employee->getDesignation(),
            'address' => $employee->getAddress(),
            'status' => (int)$employee->getStatus(),
            'hobbies' => $employee->getHobbies()
        ];
    }
}