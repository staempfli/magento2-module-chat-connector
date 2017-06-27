<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model\ResourceModel\Queue;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Staempfli\ChatConnector\Model\Queue', 'Staempfli\ChatConnector\Model\ResourceModel\Queue');
    }

    /**
     * @return $this
     */
    public function addOnlyForSendingFilter()
    {
        $this->getSelect()->where('main_table.processed_at IS NULL');
        return $this;
    }
}
