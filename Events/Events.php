<?php

namespace Staempfli\ChatConnector\Events;

use Magento\Framework\Event\ManagerInterface;

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
     * Events constructor.
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        ManagerInterface $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    /**
     * @param string $message
     */
    public function notify(string $message)
    {
        $this->eventManager->dispatch(
            'chatconnector_notification',
            [
                'event' => $this,
                'message' => $message,
            ]
        );
    }
}
