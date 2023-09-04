<?php

namespace App\Services\Salla;

use Illuminate\Http\Request;

/**
 * Interface client
 */
interface ClientInterface
{
    public function setHeaders();

    public function getHttpRequest($url, $params = []);

    public function postHttpRequest($url, $body = []);

    public function redirectAway();

    public function handleCallback(Request $request);
}
