<?php
/**
 * @category  Staempfli
 * @package   Staempfli_ChatConnector
 * @copyright Copyright © Stämpfli AG. All rights reserved.
 * @author    marcel.hauri@staempfli.com
 */

namespace Staempfli\ChatConnector\Events\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Staempfli\ChatConnector\Events\Events;

class SalesNewOrder extends Events implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();
        $this->notify(__(
            "<strong>A new order has been placed.</strong>\n<strong>Order ID:</strong> %1\n<strong>Name:</strong> %2\n<strong>Subtotal:</strong> %3\n<strong>Shipping & Handling:</strong> %4\n <strong>Grand Total:</strong> %5",
            $order->getIncrementId(),
            $this->getCustomerName($order),
            $order->formatPrice($order->getBaseSubtotalInclTax()),
            $order->formatPrice($order->getBaseShippingInclTax()),
            $order->formatPrice($order->getBaseGrandTotal())
        ));
    }

    /**
     * @param $order
     * @return string
     */
    private function getCustomerName($order)
    {
        $customerName = '';

        if ($order->getBillingAddress()) {
            $customerName = sprintf('%s %s',
                $order->getBillingAddress()->getFirstname(),
                $order->getBillingAddress()->getLastname()
            );
        }

        if ($order->getCustomerFirstname()) {
            $customerName = sprintf('%s %s',
                $order->getCustomerFirstname(),
                $order->getCustomerLastname()
            );
        }

        if ($order->getCustomerIsGuest()) {
            $customerName = sprintf('%s (Guest)', $customerName);
        }

        return $customerName;
    }
}
