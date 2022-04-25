<?php
namespace Magecomp\Productimageinorder\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag('productimageinorder/general/enabled');
    }

    public function getTemplate()
    {
        if ($this->scopeConfig->isSetFlag('productimageinorder/general/enabled')) {
            $template = 'Magecomp_Productimageinorder::order/view/items.phtml';
        } else {
            $template = 'Magento_Sales::order/view/items.phtml';
        }

        return $template;
    }

    public function getOrderRendererDefaultTemplate()
    {
        if ($this->scopeConfig->isSetFlag('productimageinorder/general/enabled')) {
            $template = 'Magecomp_Productimageinorder::order/view/items/renderer/default.phtml';
        } else {
            $template = 'Magento_Sales::order/view/items/renderer/default.phtml';
        }

        return $template;
    }
}