<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentSoftware extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'license_key',
        'expiry_date',
        'version,'
    ];

    public function equipment(): BelongsTo 
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function software(): BelongsTo 
    {
        return $this->belongsTo(Software::class, 'software_id');
    }
}
