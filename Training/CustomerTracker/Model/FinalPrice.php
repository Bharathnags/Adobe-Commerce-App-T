<?php

namespace Training\CustomerTracker\Model;

class FinalPrice extends \Magento\Catalog\Pricing\Price\FinalPrice
{
    public function getValue()
    {
        $originalPrice = parent::getValue();
        return $originalPrice + 10;
    }
}