<?php
namespace Magecomp\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const OFFER_NOTIFICATION_ENABLE = 'adminnotify/offer/enable';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function IsOfferNotification()
    {
        return $this->scopeConfig->getValue(self::OFFER_NOTIFICATION_ENABLE, ScopeInterface::SCOPE_STORE);
    }

}
