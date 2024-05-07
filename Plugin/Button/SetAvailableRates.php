<?php
declare(strict_types=1);

namespace Amwal\AvailableRates\Plugin\Button;

use Amwal\Payments\Model\Checkout\GetQuote;
use Magento\Quote\Model\Quote;

class SetAvailableRates
{
    const CARRIER_CODES = [
        'storepickup',
        'pickupatstore'
    ];

    /**
     * @param GetQuote $subject
     * @param array $result
     * @param Quote $quote
     * @return array
     */
    public function afterGetAvailableRates(GetQuote $subject, array $result, Quote $quote): array
    {
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
