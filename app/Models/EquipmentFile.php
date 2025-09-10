<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentFile extends Model
{
    use HasFactory;

    protected $table = 'equipment_files';

    protected $fillable = [
        'path_to_file',
        'equipment_id',
        'type_file_id',
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeEquipmentFile::class,'type_file_id');
    }
}
