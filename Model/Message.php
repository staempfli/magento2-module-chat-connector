<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model;

use Staempfli\ChatConnector\Api\Data\MessageInterface;

class Message implements MessageInterface
{
    /**
     * @var array
     */
    private $requestData = [
        'url' => '',
        'content-type' =>'application/json'
    ];
    /**
     * @var array
     */
    private $messageData = [];
    /**
     * @var string
     */
    private $event = '';
    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->requestData['url'] = $url;
        return $this;
    }

    /**
     * @param string $contentType
     * @return $this
     */
    public function setContentType(string $contentType)
    {
        $this->requestData['content-type'] = $contentType;
        return $this;
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function setRequestData(array $requestData)
    {
        foreach ($requestData as $key => $value) {
            $this->requestData[$key] = $value;
        }
        return $this;
    }

    /**
     * @param array $messageData
     * @return $this
     */
    public function setMessageData(array $messageData)
    {
        $this->messageData = $messageData;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * @return array
     */
    public function getMessageData()
    {
        return $this->messageData;
    }

    /**
     * @param string|object $event
     * @return $this
     */
    public function setEvent($event)
    {
        $this->event = $event;

        if (is_object($event)) {
            $this->event = get_class($event);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }
}
