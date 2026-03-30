<?php
namespace Training\CustomerTracker\Model;

class Customer extends \Magento\Customer\Model\Customer
{
    public function getName()
    {
        $name = parent::getName();
        return '⭐ ' . $name;
    }
}
