<?php
namespace Unit11\Plugins\Plugin;

class AroundBreadcrumbsPlugin
{
    public function aroundAddCrumb(
        \Magento\Theme\Block\Html\Breadcrumbs $subject,
        callable $proceed,
        $crumbName,
        $crumbInfo
    ) {
        $crumbInfo['label'] = $crumbInfo['label'] . '(!a)';
        
        return $proceed($crumbName, $crumbInfo);
    }
}
