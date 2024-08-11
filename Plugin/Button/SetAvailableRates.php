<?php
declare(strict_types=1);

namespace Amwal\AvailableRates\Plugin\Button;

use Amwal\Payments\Model\Checkout\GetQuote;
use Magento\Quote\Model\Quote;

class SetAvailableRates
{
    const CARRIER_CODES = [
        'pickupatstore_pickupatstore'
    ];

    /**
     * @param GetQuote $subject
     * @param array $result
     * @param Quote $quote
     * @return array
     */
    public function afterGetAvailableRates(GetQuote $subject, array $result, Quote $quote): array
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
        $filteredRates = [];
        foreach ($result as $key => $rate) {
            if (!$this->containsCarrierCode($key)) {
                $filteredRates[$key] = $rate;
            }
        }
        return $filteredRates;
    }

    /**
     * Check if the $key contains any carrier code defined in CARRIER_CODES
     *
     * @param string $key
     * @return bool
     */
    private function containsCarrierCode(string $key): bool
    {
        foreach (self::CARRIER_CODES as $code) {
            if (strpos($key, $code) !== false) {
                return true;
            }
        }
        return false;
    }
}
