<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusUser extends Model
{
    use HasFactory;

    protected $table = 'status_user';
    
    protected $fillable =
    [
        'user_id',
        'status_id',
        'date_from',
        'date_to',
        'comment',
    ];
}
