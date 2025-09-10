<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IpAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ip_address',
        'equipment_id',
        'vlan_id',
    ];

    public function vlan(): BelongsTo
    {
        return $this->belongsTo(Vlan::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
}
