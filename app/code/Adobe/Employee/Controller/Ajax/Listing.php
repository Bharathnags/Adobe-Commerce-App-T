<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Controller\Ajax;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;

/**
 * Class Listing
 *
 * Returns employee listing data via API.
 */
class Listing implements HttpGetActionInterface
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Listing constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        JsonFactory $jsonFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute method
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $collection = $this->collectionFactory->create();

        $items = [];

        foreach ($collection as $item) {
            $items[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'joining_date' => $item->getJoiningDate(),
                'designation' => $item->getDesignation(),
                'address' => $item->getAddress(),
                'status' => $item->getStatus(),
                'hobbies' => $item->getHobbies(),
            ];
        }

        return $this->jsonFactory->create()->setData([
            'success' => true,
            'items' => $items
        ]);
    }
}
