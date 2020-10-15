<?php

namespace App\Repositories;

use App\DTO\Pagination;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    /**
     * @param Pagination $pagination
     * @return Collection
     */
    public function get(Pagination $pagination): Collection
    {
        return Currency::query()
            ->limit($pagination->getLimit())
            ->offset($pagination->getOffsetByPage())
            ->orderByDesc('date')
            ->get();
    }

    /**
     * @param string $date
     * @param string $code
     * @return Currency|null
     */
    public function getByDateAndCode(string $date, string $code): ?Currency
    {
        /** @var Currency|null $currency */
        $currency = Currency::query()
            ->where('date', '=', $date)
            ->where('code', '=', $code)
            ->first();

        return $currency;
    }

    /**
     * @param string $date
     * @param array $data
     */
    public function save(string $date, array $data): void
    {
        Currency::create([
            'code' => $data['code'],
            'date' => $date,
            'nominal' => $data['nominal'],
            'title' => $data['currency_name'],
            'value' => str_replace(',', '.', $data['value']),
        ]);
    }
}
