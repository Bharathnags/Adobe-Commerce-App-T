<?php
namespace Unit11\Plugins\Plugin;

class BeforeBreadcrumbsPlugin
{
    public function beforeAddCrumb(
        \Magento\Theme\Block\Html\Breadcrumbs $subject,
        $crumbName,
        $crumbInfo
    ) {
        $crumbInfo['label'] = $crumbInfo['label'] . '(!b)';

        return [$crumbName, $crumbInfo];
    }
}
