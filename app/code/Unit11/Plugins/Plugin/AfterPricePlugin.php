<?php
namespace Unit11\Plugins\Plugin;

class AfterPricePlugin
{
    public function afterGetPrice(
        \Magento\Catalog\Model\Product $subject,
        $result
    ) {
        return $result + 0.5;
    }
}
