<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Staempfli\ChatConnector\Model\Config;

class Notifications implements ArrayInterface
{
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var Config
     */
    private $config;

    /**
     * Notifications constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Return options array
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $options = $this->config->getAvailableNotifications();
            foreach ($options as $id => $data) {
                $this->options[] = ['label' => $data['description'], 'value' => $id];
            }
        }
        return $this->options;
    }
}
