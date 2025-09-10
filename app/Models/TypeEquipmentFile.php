<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEquipmentFile extends Model
{
    use HasFactory;

    protected $table = 'type_equipment_files';

    public function equipmentFile(): HasMany
    {
        return $this->hasMany(EquipmentFile::class,'type_file_id');
    }
}
