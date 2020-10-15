<?php

namespace App\Contracts;

interface Formatter
{
    /**
     * @return array
     */
    public function format(): array;
}
