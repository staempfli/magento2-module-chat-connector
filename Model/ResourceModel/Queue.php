<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Queue extends AbstractDb
{
    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init('chatconnector_queue', 'entity_id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($object->isObjectNew()) {
            $object->setCreatedAt(date('Y-m-d H:i:s'));
        }
        return parent::_beforeSave($object);
    }

    public function removeProcessedMessages()
    {
        $this->getConnection()->delete($this->getMainTable(), 'processed_at IS NOT NULL');
        return $this;
    }
}
