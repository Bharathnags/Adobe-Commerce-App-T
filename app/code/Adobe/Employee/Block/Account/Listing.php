<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Block\Account;

use Magento\Framework\View\Element\Template;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;

class Listing extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getEmployees()
{
    return $this->collectionFactory->create()->getItems();
}
}