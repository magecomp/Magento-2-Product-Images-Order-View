<?php

namespace Magecomp\Base\Model\Admin\Notification;

use Magento\Backend\Model\Auth\Session;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Notification\MessageInterface;
use Magento\Security\Model\ResourceModel\AdminSessionInfo\Collection;

class Versions implements MessageInterface
{

    protected $backendUrl;
    protected $authSession;
    private $adminSessionInfoCollection;

    public function __construct(
        Collection $adminSessionInfoCollection,
        UrlInterface $backendUrl,
        Session $authSession
    )
    {
        $this->authSession = $authSession;
        $this->backendUrl = $backendUrl;
        $this->adminSessionInfoCollection = $adminSessionInfoCollection;
    }

    public function getText()
    {
        $url =$this->backendUrl->getUrl('adminhtml/system_config/edit', ['section' => "adminnotify"]);
        $link = "<a href='$url'>Update Now</a>";
        $message = __('One or More MageComp Extensions have New Versions Available. '.$link);
        return $message;
    }


    public function getIdentity()
    {
        return md5('magecomp_versions' . $this->authSession->getUser()->getLogdate());
    }

    public function isDisplayed()
    {
        return true;
    }

    public function getSeverity()
    {
        return \Magento\Framework\Notification\MessageInterface::SEVERITY_CRITICAL;
    }

}
