<?php
namespace Unit1\CustomConfig\Model\Config;

use Magento\Framework\Config\GenericSchemaLocator;

class SchemaLocator extends GenericSchemaLocator
{
    public function __construct()
    {
        $this->_schema = 'custom_config.xsd';
        $this->_perFileSchema = 'custom_config.xsd';
        $this->_moduleName = 'Unit1_CustomConfig';
    }
}
