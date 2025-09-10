<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'position',
        'inside_code',
        'email',
        'password',
        'department_id',
        'last_login_at',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function statusUser()
    {
        return $this->belongsToMany(Status::class,'status_user', 'user_id','status_id')
            ->withPivot(['date_from','date_to','comment','created_at'])
            ->orderBy('status_user.created_at', 'desc');
    }

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }


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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
