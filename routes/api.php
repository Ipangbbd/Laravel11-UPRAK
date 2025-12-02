<?php


use Orion\Facades\Orion;   
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\UserController;

Orion::resource('barangs', BarangController::class);
Orion::resource('users', UserController::class);
