<?php

use Symfony\Component\HttpFoundation\AcceptHeader;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$header = AcceptHeader::fromString(request()->headers->get('Accept'))
    ->get('application/vnd.soglasie.api+json');
$version = $header ? $header->getAttribute('version', 1) : 1;

if ($version == 1) {
    Route::namespace('V1')->group(function () {
    });
}
