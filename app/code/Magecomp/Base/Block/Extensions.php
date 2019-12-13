<?php
namespace Magecomp\Base\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Module\ModuleListInterface;

class Extensions extends Field
{
    protected $_template = 'Magecomp_Base::extensions.phtml';
    protected $_moduleList;
    public function __construct(
        Context $context,
        ModuleListInterface $moduleList,
        array $data = []
    )
    {
        $this->_moduleList = $moduleList;
        parent::__construct($context, $data);
    }

    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }
    public function getExtensions()
    {
        try {
            $allModule = $this->_moduleList->getAll();
            $xml = simplexml_load_file("http://magecomp.com/basepkg/notification/magecomp_extensions.xml");
            $html = "";
            foreach ($xml->extension as $extension) {
                foreach ($allModule as $module) {
                    if (isset($module['name'])) {
                        if (strpos($module['name'], "Magecomp") !== false) {
                            if ($module['name'] == $extension->name) {
                                $extensionUrl = " <a href=" . $extension->extension_url . " target='_blank'>".__("Update Now")."</a>";
                                $html .= "<tr>
                                            <td>" . $module['name'] . "</td>
                                            <td>" . $module['setup_version'] . "</td>
                                            <td>" . $extension->setup_version . "</td>
                                            <td>" . $extensionUrl . "</td>
                                        </tr>";
                            }

                        }
                    }
                }
            }
            return  $html;
        }
        catch(\Exception $e)
        {
            return "";
        }
    }
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }
}