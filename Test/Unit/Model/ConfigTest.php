<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */
namespace Staempfli\ChatConnector\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use PHPUnit\Framework\TestCase;
use Staempfli\ChatConnector\Model\Config;

/**
 * Class ConfigTest
 * @package Staempfli\ChatConnector\Test\Unit\Model
 */
class ConfigTest extends TestCase
{
    private $objectManagerHelper;
    private $scopeConfigInterface;
    private $config;

    protected function setUp()
    {
        $this->scopeConfigInterface = $this->getMockBuilder(ScopeConfigInterface::class)
            ->getMockForAbstractClass();
        $this->objectManagerHelper = new ObjectManagerHelper($this);
        $this->config = $this->objectManagerHelper->getObject(
            Config::class,
            [
                'scopeConfig' => $this->scopeConfigInterface,
            ]
        );
    }
}
