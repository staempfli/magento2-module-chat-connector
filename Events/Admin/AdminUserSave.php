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

class AdminUserSave extends Events implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$observer->getResult()) {
            $adminUser = $observer->getData('object');
            if (!$adminUser->getCreated()) {
                $this->notify(__(
                    "<strong>New Admin User was created!</strong>\n Username: %1 \n First Name: %2 \n Last Name: %3 \n E-Mail: %4", // @codingStandardsIgnoreLine
                    $adminUser->getUsername(),
                    $adminUser->getFirtname(),
                    $adminUser->getLastname(),
                    $adminUser->getEmail()
                ));
            }
        }
    }
}
