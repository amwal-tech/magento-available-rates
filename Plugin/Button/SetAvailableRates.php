<?php
declare(strict_types=1);

namespace Amwal\AvailableRates\Plugin\Button;

use Amwal\Payments\Model\Checkout\GetQuote;
use Magento\Quote\Model\Quote;

class SetAvailableRates
{
    const CARRIER_CODES = [
        'storepickup', 'pickupatstore'
    ];
    
    /**
     * @param GetQuote $subject
     * @param array $result
     * @param Quote $quote
     * @return array
     */
    public function afterGetAvailableRates(GetQuote $subject, array $result, $quote)
    {
        /**
         * Adjust $result to provide the shipping methods as you wish to show them in the Amwal modal.
         * The returned array must have the following format:
         * [
         *      [ID OF SHIPPING METHOD] => [
         *          'carrier_title' => [TITLE OF SHIPPING METHOD],
         *          'price' => [PRICE OF SHIPPING]
         *      ]
         * ];
         *
         * Where:
         * [ID OF SHIPPING METHOD] = The ID used for the shipping method in magento. Usually a combination of: carrier code and method name.
         * [TITLE OF SHIPPING METHOD] = The title that should be shown in the Amwal modal
         * [PRICE OF SHIPPING] = The amount that should be paid for the shipping method
         */
        foreach ($result as $key => $rate) {
            if (in_array($key, self::CARRIER_CODES)) {
                unset($result[$key]);
            }
        }
        return $result;
    }
}