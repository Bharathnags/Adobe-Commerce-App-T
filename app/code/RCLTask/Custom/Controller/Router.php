<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace RCLTask\Custom\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    protected $actionFactory;

    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
      
        if ($request->getModuleName() === 'custom') {
            return null;
        }
        $identifier = trim($request->getPathInfo(), '/');

        
        if ($identifier === 'intern') {

            $request->setModuleName('custom');
            $request->setControllerName('index');
            $request->setActionName('index');

           
            $request->setParam('name', 'Intern Name');

            return $this->actionFactory->create(
                \Magento\Framework\App\Action\Forward::class
            );
        }

        return null;
    }
}
