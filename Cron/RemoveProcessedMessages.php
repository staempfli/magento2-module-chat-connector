<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Cron;

use Staempfli\ChatConnector\Model\Queue;

class RemoveProcessedMessages
{
    /**
     * @var Queue
     */
    private $queue;

    /**
     * SendQueuedMessages constructor.
     * @param Queue $queue
     */
    public function __construct(
        Queue $queue
    ) {
        $this->queue = $queue;
    }

    public function execute()
    {
        $this->queue->removeProcessedMessages();
    }
}
