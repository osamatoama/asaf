<?php

namespace App\Services\Salla\Registration;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class RegisterService
 */
class RegisterService implements RegisterServiceInterface
{

    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data): User
    {
        $existedUser = User::where('email', $data['merchantInfo']['email'] ?? '')->first();

        return $existedUser ? $this->update($existedUser, $data) : $this->create($data);
    }


    /**
     * @param array $data
     * @return User
     */
    private function create(array $data): User
    {
        $user = new User();

        DB::transaction(function () use ($data, &$user) {
            $user = User::create([
                'name'  => $data['merchantInfo']['merchant']['name'] ?? null,
                'email' => $data['merchantInfo']['email'] ?? null,
                'phone' => $data['merchantInfo']['mobile'] ?? null,
            ]);

            $merchant       = (array) ($data['merchantInfo']['merchant'] ?? []);
            $configurations = [];

            foreach ($merchant + $this->getTokenData($data['token']) as $key => $value) {
                if ($key !== 'username' && filled($value)) {
                    $configurations[] = [
                        'key'   => ($key === 'id') ? 'remoteIdentifier' : $key,
                        'value' => $value
                    ];
                }
            }

            $user->sallaConfigurations()->createMany($configurations);
        });

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User|null
     */
    private function update(User $user, array $data): ?User
    {
        DB::transaction(function () use ($user, $data) {
            $user->update([
                'name'  => $data['merchantInfo']['merchant']['name'] ?? null,
                'email' => $data['merchantInfo']['email'] ?? null,
                'phone' => $data['merchantInfo']['mobile'] ?? null,
            ]);

            $user->sallaConfigurations()->delete();

            $merchant       = (array) ($data['merchantInfo']['merchant'] ?? []);
            $configurations = [];

            foreach ($merchant + $this->getTokenData($data['token']) as $key => $value) {
                if ($key !== 'username' && filled($value)) {
                    $configurations[] = [
                        'key'   => ($key === 'id') ? 'remoteIdentifier' : $key,
                        'value' => $value
                    ];
                }
            }

            $user->sallaConfigurations()->createMany($configurations);
        });

        return $user->fresh();
    }


    /**
     * @param $token
     * @return array
     */
    private function getTokenData($token): array
    {
        return [
            'token_type'        => 'oauth',
            'access_token'      => $token->getToken(),
            'refresh_token'     => $token->getRefreshToken(),
            'token_expired_at'  => Carbon::parse($token->getExpires())->format('Y-m-d H:i:s')
        ];
    }
}
