<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Queue extends AbstractModel implements IdentityInterface
{
    const STATUS_PENDING = 1;
    const STATUS_PROCESSED = 2;
    const STATUS_FAILED = 3;

    /**
     * Cache tag
     */
    const CACHE_TAG = 'chatconnector_queue';

    /**
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     * @var string
     */
    protected $_cacheTag = 'chatconnector_queue';

    /**
     * Prefix of model events names
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     * @var string
     */
    protected $_eventPrefix = 'chatconnector_queue';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Staempfli\ChatConnector\Model\ResourceModel\Queue');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [
            sprintf(
                '%s_%d',
                self::CACHE_TAG,
                $this->getId()
            )
        ];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->getResource()->save($this);
        }
        return $this;
    }

    /**
     * @param array $messageData
     * @param array $requestData
     * @return bool
     */
    public function addMessageToQueue(array $messageData, array $requestData)
    {
        try {
            $this->unsetData()
                ->setMessageData(json_encode($messageData))
                ->setRequestData(json_encode($requestData))
                ->save();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function removeProcessedMessages()
    {
        $this->getResource()->removeProcessedMessages();
    }
}
