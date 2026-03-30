<?php

namespace Unit2\AdobeLastname\Plugin;

use Magento\Customer\Api\Data\CustomerInterface;

class AccountManagementPlugin
{
    public function beforeCreateAccount(
        \Magento\Customer\Api\AccountManagementInterface $subject,
        CustomerInterface $customer,
        $password = null,
        $redirectUrl = ''
    ) {
        $email = $customer->getEmail();

        
        if ($this->isAdobeEmail($email)) {
            $lastName = $customer->getLastname();

        
            if (stripos($lastName, 'Adobe') === false) {
                $customer->setLastname($lastName . ' Adobe');
            }
        }

        return [$customer, $password, $redirectUrl];
    }

    private function isAdobeEmail($email)
    {
        $parts = explode('@', $email);

        if (count($parts) !== 2) {
            return false;
        }

        return strtolower($parts[1]) === 'adobe.com';
    }
}
