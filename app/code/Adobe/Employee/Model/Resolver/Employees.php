<?php

namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Employees implements ResolverInterface
{
    protected $employeeRepository;
    protected $searchCriteriaBuilder;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function resolve(
        $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $result = $this->employeeRepository->getList($searchCriteria);

        $employees = [];

        foreach ($result->getItems() as $employee) {
    $employees[] = [
        'id' => (int)$employee->getId(),
        'name' => $employee->getName(),
        'designation' => $employee->getDesignation(),
        'address' => $employee->getAddress(),
        'status' => (int)$employee->getStatus(),
        'hobbies' => $employee->getHobbies()
    ];
}

        return $employees;
    }
}