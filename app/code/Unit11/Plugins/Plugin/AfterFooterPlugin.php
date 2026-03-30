<?php
namespace Unit11\Plugins\Plugin;

class AfterFooterPlugin
{
    public function afterGetCopyright(
        \Magento\Theme\Block\Html\Footer $subject,
        $result
    ) {
        return 'Customized copyright!';
    }
}
