<?php

namespace App\Services\Salla;

use Illuminate\Http\Request;

/**
 * Interface client
 */
interface ClientInterface
{
    public function setHeaders();

    public function getHttpRequest(string $url, $params = []);

    public function postHttpRequest(string $url, $body = []);

    public function redirectAway();

    public function handleCallback(Request $request);
}
