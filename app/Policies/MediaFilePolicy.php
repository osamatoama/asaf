<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MediaFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaFilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function view(User $user, MediaFile $file)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function create(User $user)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function update(User $user, MediaFile $file)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function delete(User $user, MediaFile $file)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function deleteAny(User $user)
    {
        return false;
    }

    private function hasMediaAccessPermission(User $user)
    {
        $role = $user->roles->first();
        $permissions = $role->permissions;

        return $permissions->pluck('title')->contains('media_access');
    }
}
