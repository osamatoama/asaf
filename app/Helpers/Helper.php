<?php

if (!function_exists('randomCode')) {
    /**
     * @throws Exception
     */
    function randomCode(): int
    {
        return random_int(1000, 9999);
    }
}
