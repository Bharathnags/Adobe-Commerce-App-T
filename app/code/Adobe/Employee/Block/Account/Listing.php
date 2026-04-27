<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Block\Account;

use Magento\Framework\View\Element\Template;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;

/**
 * Class Listing
 *
 * Provides employee listing data to the template.
 */
class Listing extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Listing constructor.
     *
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get employees list
     *
     * @return \Adobe\Employee\Model\Employee[]
     */
    public function getEmployees()
    {
        return $this->collectionFactory->create()->getItems();
    }
}