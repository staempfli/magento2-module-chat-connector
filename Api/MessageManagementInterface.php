<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Api;

use Staempfli\ChatConnector\Api\Data\MessageInterface;

/**
 * @api
 */
interface MessageManagementInterface
{
    /**
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message);
}
