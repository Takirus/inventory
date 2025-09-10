<?php

namespace App\Models;

use Database\Factories\TypeEquipmentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\BinaryOp\Equal;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function type(): HasMany {
        return $this->hasMany(Equipment::class, 'type_file_id');
    }


}
