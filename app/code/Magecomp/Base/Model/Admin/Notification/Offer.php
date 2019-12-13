<?php

namespace Magecomp\Base\Model\Admin\Notification;

use Magento\Backend\Model\Auth\Session;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Notification\MessageInterface;
use Magecomp\Base\Helper\Data;
class Offer implements MessageInterface
{
    protected $backendUrl;
    protected $authSession;
    protected $helper;

    public function __construct(
        UrlInterface $backendUrl,
        Session $authSession,
        Data $helper
    )
    {
        $this->authSession = $authSession;
        $this->backendUrl = $backendUrl;
        $this->helper = $helper;
    }

    public function getText()
    {
        $xml=simplexml_load_file("http://magecomp.com/basepkg/notification/magecomp_extensions.xml") ;
        if($this->helper->IsOfferNotification() && $xml->offer->content)
            return "".$xml->offer->content;
        else
            return "";
    }

    public function getIdentity()
    {
        return md5('magecomp_offer' . $this->authSession->getUser()->getLogdate());
    }

    public function isDisplayed()
    {
        if($this->helper->IsOfferNotification())
            return true;
        else
            return false;
    }

    public function getSeverity()
    {
        return \Magento\Framework\Notification\MessageInterface::SEVERITY_CRITICAL;
    }
}