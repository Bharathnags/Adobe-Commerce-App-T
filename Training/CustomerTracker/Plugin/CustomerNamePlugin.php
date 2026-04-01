<?php
namespace Training\CustomerTracker\Plugin;

use Magento\Customer\CustomerData\Customer;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

class CustomerNamePlugin
{
    private ScopeConfigInterface $scopeConfig;
    private LoggerInterface $logger;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    public function afterGetSectionData(Customer $subject, $result)
    {
        $enabled = $this->scopeConfig->getValue(
            'customertracker/general/enabled',
            ScopeInterface::SCOPE_STORE
        );

        if (!$enabled) {
            return $result;
        }

        $prefix = $this->scopeConfig->getValue(
            'customertracker/general/customer_prefix',
            ScopeInterface::SCOPE_STORE
        );

        if ($prefix && isset($result['fullname'])) {
            $result['fullname'] = $prefix . ' ' . $result['fullname'];
            $this->logger->info('Customer name modified to: ' . $result['fullname']);
        }

        return $result;
    }
}