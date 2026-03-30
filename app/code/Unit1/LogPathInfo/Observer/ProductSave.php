<?php

namespace Unit1\LogPathInfo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class ProductSave implements ObserverInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer): void
    {
        $product = $observer->getEvent()->getProduct();
        if ($product) {
            $this->logger->info('Product "' . $product->getName() . '" has been saved');
        }
    }
}
