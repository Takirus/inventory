<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStatusHistory extends Model
{
    use HasFactory;
    protected $table='request_status_history';

    protected $fillable = [
        'request_id',
        'status_id',
        'changed_by_user_id',
        'changed_at',
        'closed_at',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function status()
    {
        return $this->belongsTo(RequestStatus::class);
    }
    
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}
