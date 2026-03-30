<?php
namespace Bnags\CustomFeature\Plugin;

use Bnags\CustomFeature\Helper\Data;

class ProductPlugin
{
    protected $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    public function afterGetName($subject, $result)
    {
        if (!$this->helper->isEnabled()) {
            return $result; // Feature OFF
        }

        if (!is_string($result)) {
            $result = '';
        }

    // Prevent double [Bnags]
        if (strpos($result, '[Bnags]') === 0) {
            return $result;
        }

        return '[Bnags] ' . $result;
    }
}
