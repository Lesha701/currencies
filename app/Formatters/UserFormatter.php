<?php

namespace App\Formatters;

use App\Contracts\Formatter;
use App\Models\User;

class UserFormatter implements Formatter
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserFormatter constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return collect($this->user)
            ->only('name', 'email', 'api_token')
            ->toArray();
    }
}
