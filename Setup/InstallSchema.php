<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Staempfli\ChatConnector\Model\Queue;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();
        /**
         * Create table 'chatconnector_queue'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('chatconnector_queue')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Queue ID'
        )->addColumn(
            'request_data',
            Table::TYPE_TEXT,
            null,
            [
                'nullable' => false,
                'default' => ''
            ],
            'Request Data'
        )->addColumn(
            'message_data',
            Table::TYPE_TEXT,
            null,
            [
                'nullable' => false,
                'default' => ''
            ],
            'Message Data'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => true],
            'Created At'
        )->addColumn(
            'processed_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => true],
            'Processed At'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => true,
                'default' => Queue::STATUS_PENDING
            ],
            'Status'
        )->setComment(
            'Queue Table'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
