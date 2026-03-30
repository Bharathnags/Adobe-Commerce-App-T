<?php
namespace Unit2\FlushOutput\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class LogPageOutput implements ObserverInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $response = $observer->getEvent()->getData('response');

        // Get full HTML
        $body = $response->getBody();

        // Limit to first 1000 characters (important!)
        $body = substr($body, 0, 1000);

        $this->logger->info("-------- PAGE HTML --------\n" . $body);
    }
}
