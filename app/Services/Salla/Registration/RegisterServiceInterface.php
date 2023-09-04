<?php


namespace App\Services\Salla\Registration;

use App\Models\User;

/**
 * Interface RegisterService
 */
interface RegisterServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data): User;
}
