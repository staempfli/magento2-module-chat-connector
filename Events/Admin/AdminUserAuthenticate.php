<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Events\Admin;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Staempfli\ChatConnector\Events\Events;

class AdminUserAuthenticate extends Events implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * AdminUserAuthenticate constructor.
     * @param RequestInterface $request
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        RequestInterface $request,
        ManagerInterface $eventManager
    ) {
        parent::__construct($eventManager);
        $this->request = $request;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$observer->getResult()) {
            $this->notify(__(
                "<strong>Admin user login failed!</strong>\n Username: %1 \n Password: %2 \n IP: %3",
                $observer->getUsername(),
                $this->getObscuredPassword($observer->getPassword()),
                $this->request->getServer('REMOTE_ADDR')
            ));
        }
    }

    /**
     * @param string $password
     * @return string
     */
    private function getObscuredPassword(string $password)
    {
        $passwordLength = strlen($password);
        return sprintf('%s%s%s',
            substr($password, 0, 1),
            str_repeat('*', ($passwordLength - 2)),
            substr($password, -1)
        );
    }
}
