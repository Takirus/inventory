<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type_id',
        'serial_code',
        'manufacturer',
        'model',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logins(): BelongsTo
    {
        return $this->BelongsTo(Login::class);
    }

    public function statusEquipment()
    {
        return $this->belongsToMany(Status::class,'status_equipment', 'equipment_id','status_id')
            ->withPivot(['date_from','date_to','comment','created_at'])
            ->orderBy('status_equipment.created_at', 'desc');
    }

    public function ip_address(): HasOne
    {
        return $this->hasOne(IpAddress::class);
    }

    public function typeEquipment(): BelongsTo 
    {
        return $this->belongsTo(TypeEquipment::class, 'type_id');
    }

    public function file(): HasMany 
    {
        return $this->hasMany(EquipmentFile::class);

    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function equipmentVersion():BelongsToMany
    {
        return $this->belongsToMany(Software::class,'equipment_software','equipment_id','software_id')
        ->withPivot('version','expiry_date','created_at')
        ->orderBy('equipment_software.created_at', 'desc');;
    }
}
