<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Api\Data;

/**
 * @api
 */
interface MessageInterface
{
    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url);

    /**
     * @param string $contentType
     * @return $this
     */
    public function setContentType(string $contentType);

    /**
     * @param array $requestData
     * @return mixed
     */
    public function setRequestData(array $requestData);

    /**
     * @param array $messageData
     * @return $this
     */
    public function setMessageData(array $messageData);

    /**
     * @param string|object $event
     * @return $this
     */
    public function setEvent($event);

    /**
     * @return array
     */
    public function getRequestData();

    /**
     * @return array
     */
    public function getMessageData();

    /**
     * @return string
     */
    public function getEvent();
}
