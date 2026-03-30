<?php
namespace Unit1\CustomConfig\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{
    public function convert($source)
    {
        $output = [];
        $xpath = new \DOMXPath($source);
        $messages = $xpath->evaluate('/config/welcome_message');

        foreach ($messages as $messageNode) {
            $storeId = $messageNode->attributes->getNamedItem('store_id')->nodeValue ?? null;
            $output['messages'][$storeId] = ['message' => $messageNode->nodeValue];
        }

        return $output;
    }
}
