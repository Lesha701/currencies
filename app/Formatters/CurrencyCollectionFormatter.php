<?php

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyCollectionFormatter implements Formatter
{
    /**
     * @var Collection
     */
    private $currencyCollection;

    /**
     * CurrencyCollectionFormatter constructor.
     * @param Collection $currencyCollection
     */
    public function __construct(Collection $currencyCollection)
    {
        $this->currencyCollection = $currencyCollection;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return $this->currencyCollection->map(function (Currency $currency) {
            return (new CurrencyFormatter($currency))->format();
        })->toArray();
    }
}
