<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Adobe\Employee\Model\EmployeeFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * Create Employee Resolver
 */
class CreateEmployee implements ResolverInterface
{
    /**
     * @var EmployeeFactory
     */
    protected $employeeFactory;

    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * @param EmployeeFactory $employeeFactory
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(
        EmployeeFactory $employeeFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Resolve method
     *
     * @param mixed $field
     * @param mixed $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     */
    public function resolve(
        $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        $employee = $this->employeeFactory->create();

        $employee->setName($args['name']);
        $employee->setDesignation($args['designation'] ?? '');
        $employee->setAddress($args['address'] ?? '');
        $employee->setStatus($args['status'] ?? 1);
        $employee->setHobbies($args['hobbies'] ?? []);

        $this->employeeRepository->save($employee);

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
