<?php

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Models\Currency;

class CurrencyFormatter implements Formatter
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * CurrencyFormatter constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return [
            'code' => $this->currency->getCode(),
            'date' => $this->currency->getFormattedDate(),
            'nominal' => $this->currency->getNominal(),
            'title' => $this->currency->getTitle(),
            'value' => $this->currency->getValue(),
        ];
    }
}
