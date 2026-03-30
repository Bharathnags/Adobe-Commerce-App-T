<?php
namespace Unit1\CustomConfig\Model;

use Magento\Framework\Config\Data;
use Magento\Framework\Config\ReaderInterface;
use Magento\Framework\Config\CacheInterface;

class Config extends Data
{
    public function __construct(ReaderInterface $reader, CacheInterface $cache, $cacheId = '')
    {
        parent::__construct($reader, $cache, $cacheId);
    }
}
