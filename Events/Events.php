<?php

namespace Staempfli\ChatConnector\Events;

use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Staempfli\ChatConnector\Model\Config;

/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
abstract class Events
{
    /**
     * @var ManagerInterface
     */
    private $eventManager;
    /**
     * @var Config
     */
    private $config;

    /**
     * Events constructor.
     * @param ManagerInterface $eventManager
     * @param Config $config
     */
    public function __construct(
        ManagerInterface $eventManager,
        Config $config
    ) {
        $this->eventManager = $eventManager;
        $this->config = $config;
    }

    /**
     * @param string $message
     */
    public function notify(string $message)
    {
        if ($this->config->isNotificationAllowed($this)) {
            $this->eventManager->dispatch(
                'chatconnector_notification',
                [
                    'message' => $message,
                ]
            );
        }
    }
}
