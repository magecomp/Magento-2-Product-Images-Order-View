<?php
namespace Magecomp\Base\Block;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Store extends Field
{
    public function render(AbstractElement $element)
    {
        $element = "<iframe id='magecomp_store' src='http://magecomp.com/basepkg/marketplace/marketplace.html' frameborder='0' width='100%' scrolling='no'></iframe>";
        return $element;
    }
}