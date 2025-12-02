<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Orion\Concerns\DisableAuthorization;
class UserController extends Controller
{
    use DisableAuthorization;

    protected $model = User::class;
}
