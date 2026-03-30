<?php

namespace Unit1\LogPathInfo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RequestInterface;

class Log implements ObserverInterface
{
    private LoggerInterface $logger;
    private RequestInterface $request;

    public function __construct(
        LoggerInterface $logger,
        RequestInterface $request
    ) {
        $this->logger = $logger;
        $this->request = $request;
    }

    public function execute(Observer $observer): void
    {
        $path = $this->request->getPathInfo();

        $this->logger->info('Request Path: ' . $path);
    }
}
