<?php
namespace Training\CustomerTracker\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class CustomerLoginObserver implements ObserverInterface
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        
        $this->logger->info('Customer Logged In: ' . $customer->getEmail());
    }
}
