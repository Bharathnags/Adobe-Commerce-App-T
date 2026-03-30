<?php
namespace Bnags\CustomFeature\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Bnags\CustomFeature\Helper\Data;

class ProductSave implements ObserverInterface
{
    protected $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    public function execute(Observer $observer)
    {
        // Exit early if feature is OFF
        if (!$this->helper->isEnabled()) {
            return;
        }

        $product = $observer->getProduct();
        $originalName = $product->getOrigData('name');
        $newName = $product->getName();

        // Only append suffix if changed AND not already appended
        if ($originalName !== $newName && strpos($newName, '[custom change by Bharath]') === false) {
            $product->setName($newName . ' [custom change by Bharath]');
        }
    }
}
