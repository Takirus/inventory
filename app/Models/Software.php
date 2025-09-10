<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Software extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'vendor',
        'expiry_date',
    ];

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function softwareVersion():BelongsToMany
    {
        return $this->belongsToMany(Equipment::class,'equipment_software','software_id','equipment_id')
        ->withPivot('version','expiry_date','created_at');
    }
}
