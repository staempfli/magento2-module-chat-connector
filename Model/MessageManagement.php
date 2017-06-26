<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model;

use GuzzleHttp\Client;
use Staempfli\ChatConnector\Api\Data\MessageInterface;
use Staempfli\ChatConnector\Api\MessageManagementInterface;

class MessageManagement implements MessageManagementInterface
{
    /**
     * @var Queue
     */
    private $queue;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Config
     */
    private $config;

    /**
     * Message constructor.
     * @param Queue $queue
     * @param Client $client
     * @param Config $config
     * @internal param Queue $queue
     */
    public function __construct(
        Queue $queue,
        Client $client,
        Config $config
    ) {
        $this->queue = $queue;
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message)
    {
        if ($this->config->useQueue()) {
            $this->queue->addMessageToQueue($message->getMessageData(), $message->getRequestData());
        } else {
            $this->sendRequest($message->getRequestData(), $message->getMessageData());
        }
    }

    /**
     * @param array $requestData
     * @param array $messageData
     * @return bool
     */
    public function sendRequest(array $requestData, array $messageData)
    {
        if (!$this->config->isActive()) {
            return false;
        }
        /**
         * @var Client
         */
        $client = $this->client;
        try {
            $result = $client->post($requestData['url'], ['json' => $messageData]);
            if ((int) substr($result->getStatusCode(), 0, 1) === 2) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}
