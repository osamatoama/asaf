<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MediaFolder;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaFolderPolicy
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

    public function view(User $user, MediaFolder $folder)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function create(User $user)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function update(User $user, MediaFolder $folder)
    {
        return $this->hasMediaAccessPermission($user);
    }

    public function delete(User $user, MediaFolder $folder)
    {
        return $this->hasMediaAccessPermission($user) && $folder->files->isEmpty();
    }

    public function deleteAny(User $user)
    {
        return false;
    }

    private function hasMediaAccessPermission(User $user)
    {
        return true;

        // $role = $user->roles->first();
        // $permissions = $role->permissions;

        // return $permissions->pluck('title')->contains('media_access');
    }
}
