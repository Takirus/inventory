<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'equipment_id',
        'current_status_id',
    ];
    
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function equipment(): BelongsTo 
    {
        return $this->belongsTo(Equipment::class);
    }

    public function status(): BelongsTo 
    {
        return $this->belongsTo(RequestStatus::class,'current_status_id');
    }

    public function requestHistory(): HasMany
    {
        return $this->hasMany(RequestStatusHistory::class);
    }

    public function lastStatus()
    {
        return $this->hasOne(RequestStatusHistory::class)->latestOfMany();
    }
}
