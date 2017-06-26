<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Staempfli\ChatConnector\Events\Events;

class Config
{
    const XML_PATH_ENABLED = 'chatconnector/general/enabled';
    const XML_PATH_USE_QUEUE = 'chatconnector/general/queue';
    const XML_PATH_CHAT_CONNECTOR_ACTIVE_NOTIFICATIONS = 'chatconnector/general/notifications';
    const XML_PATH_CHAT_CONNECTOR_NOTIFICATIONS = 'chatconnector/notifications';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (boolean) $this->scopeConfig->getValue(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function useQueue()
    {
        return (boolean) $this->scopeConfig->getValue(self::XML_PATH_USE_QUEUE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return array
     */
    public function getAvailableNotifications()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CHAT_CONNECTOR_NOTIFICATIONS, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return array
     */
    public function getActiveNotifications()
    {
        $data = [];
        $activeNotifications = $this->scopeConfig->getValue(self::XML_PATH_CHAT_CONNECTOR_ACTIVE_NOTIFICATIONS, ScopeInterface::SCOPE_STORE);
        $availableNotifications = $this->getAvailableNotifications();
        $notifications = explode(',', trim($activeNotifications));
        foreach ($notifications as $notification) {
            if (isset($availableNotifications[$notification])
                && isset($availableNotifications[$notification]['class'])
            ) {
                $data[$notification] = ltrim($availableNotifications[$notification]['class'], "\\");
            }
        }
        return $data;
    }

    /**
     * @param Events $event
     * @return bool
     */
    public function isNotificationAllowed(Events $event)
    {
        $activeNotifications = $this->getActiveNotifications();
        if (in_array(get_class($event), array_values($activeNotifications))) {
            return true;
        }
        return false;
    }
}
