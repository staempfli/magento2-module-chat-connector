<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Cron;

use Staempfli\ChatConnector\Model\MessageManagement;
use Staempfli\ChatConnector\Model\Queue;

class ProcessQueuedMessages
{
    const MESSAGES_LIMIT_PER_CRON_RUN = 45;

    /**
     * @var Queue
     */
    protected $queue;
    /**
     * @var MessageManagement
     */
    protected $messageManagement;

    /**
     * SendQueuedMessages constructor.
     * @param Queue $queue
     * @param MessageManagement $messageManagement
     */
    public function __construct(
        Queue $queue,
        MessageManagement $messageManagement
    ) {
        $this->queue = $queue;
        $this->messageManagement = $messageManagement;
    }

    public function execute()
    {
        $collection = $this->queue->getCollection()
            ->addOnlyForSendingFilter()
            ->setPageSize(self::MESSAGES_LIMIT_PER_CRON_RUN)
            ->setCurPage(1)
            ->load();

        foreach ($collection as $message) {
            $result = $this->messageManagement->sendRequest(
                $this->decodeData($message->getRequestData()),
                $this->decodeData($message->getMessageData())
            );
            if ($result) {
                $message->setProcessedAt(date('Y-m-d H:i:s'))->save();
            }
            // Slack rate limits, see: https://api.slack.com/docs/rate-limits
            sleep(1);
        }
    }

    /**
     * @param string $data
     * @return array
     */
    private function decodeData(string $data)
    {
        return json_decode($data, true);
    }
}
