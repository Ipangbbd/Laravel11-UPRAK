<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use App\Models\Barang;
use Orion\Concerns\DisableAuthorization;

class BarangController extends Controller
{
    use DisableAuthorization; // agar tidak butuh auth

    protected $model = Barang::class;
}
