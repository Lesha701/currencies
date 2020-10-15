<?php

namespace App\Http\Controllers;

use App\Formatters\UserFormatter;
use App\Models\User;
use App\Response\SuccessResponse;

class UserController extends Controller
{
    public function getAdmin(): SuccessResponse
    {
        /** @var User $admin */
        $admin = User::query()
            ->where('name', '=', 'Admin')
            ->first();

        return new SuccessResponse(
            (new UserFormatter($admin))->format()
        );
    }
}
