<?php
namespace Unit1\CustomConfig\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Unit1\CustomConfig\Model\Config;

class Index extends Action
{
    private $customConfig;

    public function __construct(Context $context, Config $customConfig)
    {
        $this->customConfig = $customConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        $storeId = 2; // Example: Canadian customer
        $storeWelcomeMsg = $this->customConfig->get('messages/' . $storeId . '/message');

        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($storeWelcomeMsg);

        return $result;
    }
}
