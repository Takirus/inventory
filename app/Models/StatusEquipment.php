<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEquipment extends Model
{
    use HasFactory;

    protected $table = 'status_equipment';
    
    protected $fillable =
    [
        'equipment_id',
        'status_id',
        'date_from',
        'date_to',
        'comment',
    ];
}
