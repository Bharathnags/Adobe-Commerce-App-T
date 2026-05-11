<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Model;

use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * Employee queue publisher
 */
class Publisher
{
    /**
     * Topic name
     */
    const TOPIC_NAME = 'employee.status.update';

    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct(
        PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Publish employee status message
     *
     * @param string $data
     * @return void
     */
    public function publish($data)
    {
        $this->publisher->publish(
            self::TOPIC_NAME,
            $data
        );
    }
}
