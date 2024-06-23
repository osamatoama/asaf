<?php

namespace App\Models;

use Filament\Panel;
use App\Models\Traits\Auditable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\User\UserHelpers;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\User\UserRelations;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, UserHelpers, UserRelations, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'email',
        'phone',
        'password',
        'verification_code',
        'verified',
        'active',
        'dark_mode_enabled'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'verified'          => 'boolean',
        'active'            => 'boolean',
        'dark_mode_enabled' => 'boolean',
        'created_at'        => 'datetime:Y-m-d H:i:s',
        'updated_at'        => 'datetime:Y-m-d H:i:s',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email == 'admin@admin.com' || $this->can('media_access');
    }
}
