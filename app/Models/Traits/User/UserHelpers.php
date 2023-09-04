<?php

namespace App\Models\Traits\User;

/**
 * Trait UserHelpers
 */
trait UserHelpers
{

    /**
     * @return mixed
     */
    public function getSallaAccessToken(): mixed
    {
        return optional($this->sallaConfigurations()
            ->where('key', 'access_token')
            ->first())->value;
    }
}
