<?php

namespace App\Services;

use Carbon\Carbon;
use DiDom\Document;
use DiDom\Element;
use DiDom\Exceptions\InvalidSelectorException;

class HtmlCurrencyParser
{
    private const URL = 'http://cbr.ru/currency_base/daily/?UniDbQuery.Posted=True&UniDbQuery.To=';

    private const DATA_KEYS = [
        'digit_code',
        'code',
        'nominal',
        'currency_name',
        'value'
    ];

    /**
     * @param string|null $date
     * @return array
     */
    public function parse(?string $date = null): array
    {
        if ($date == null) {
            $date = (new Carbon())->format('d.m.Y');
        }

        $result = [];
        $result['date'] = Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
        $result['currencies'] = [];
        $document = new Document(self::URL . $date, true);

        try {
            foreach ($document->find('table.data tr') as $row) {
                if ($row->has('td')) {
                    $result['currencies'][] = array_combine(
                        self::DATA_KEYS,
                        array_map(function (Element $element) {
                            return $element->text();
                        }, $row->find('td'))
                    );
                }
            }
        } catch (InvalidSelectorException $e) {
            return [];
        }

        return $result;
    }
}
