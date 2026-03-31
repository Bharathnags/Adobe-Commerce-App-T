<?php
namespace Training\CustomerTracker\Plugin;

use Magento\Customer\Model\Customer;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CustomerNamePlugin
{
    private $scopeConfig;
    
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }
    
    public function afterGetName(Customer $customer, $result)
    {
      
        $enabled = $this->scopeConfig->getValue('customertracker/general/enabled');
        
        if (!$enabled) {
            return $result;
        }
        
       
        $prefix = $this->scopeConfig->getValue('customertracker/general/customer_prefix');
        
        
        if ($prefix) {
            return $prefix . ' ' . $result;
        }
        
        return $result;
    }
}
