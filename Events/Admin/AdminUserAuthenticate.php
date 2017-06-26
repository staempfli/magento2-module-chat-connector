<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Events\Admin;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Staempfli\ChatConnector\Events\Events;

class AdminUserAuthenticate extends Events implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$observer->getResult()) {
            $this->notify(__(
                "<strong>Admin user login failed!</strong>\n Username: %1 \n Password: %2",
                $observer->getUsername(),
                $observer->getPassword()
            ));
        }
    }
}
