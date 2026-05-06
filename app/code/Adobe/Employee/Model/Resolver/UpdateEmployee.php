<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Model\Resolver;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Update Employee Resolver
 */
class UpdateEmployee implements ResolverInterface
{
    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    /**
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository
    ) {
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
     *
     * @return array
     *
     * @throws GraphQlInputException
     */
    public function resolve(
        $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if (empty($args['id'])) {
            throw new GraphQlInputException(__('Employee ID is required'));
        }

        try {
            $employee = $this->employeeRepository->getById($args['id']);
        } catch (\Exception $e) {
            throw new GraphQlInputException(__('Employee not found'));
        }

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
            $employee->setHobbies($args['hobbies']);
        }

        $this->employeeRepository->save($employee);

        return [
            'id'          => (int) $employee->getId(),
            'name'        => $employee->getName(),
            'designation' => $employee->getDesignation(),
            'address'     => $employee->getAddress(),
            'status'      => (int) $employee->getStatus(),
            'hobbies'     => $employee->getHobbies()
        ];
    }
}
