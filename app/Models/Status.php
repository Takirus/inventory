<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'name',
        'description',
    ];

    public function status_user()
    {
        return $this->belongsToMany(User::class,'status_user','status_id','user_id')
            ->withPivot(['date_from','date_to','comment','created_at']);
    }

    public function status_equipment()
    {
        return $this->belongsToMany(Equipment::class,'status_equipment','status_id','equipment_id')
            ->withPivot(['date_from','date_to','comment','created_at']);
    }
}
