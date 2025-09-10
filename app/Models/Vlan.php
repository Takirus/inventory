<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vlan extends Model
{
    use HasFactory;


    protected $table = 'vlan';
    
    protected $fillable = [
        'name',
        'description',
        'subnet',
    ];

    public function ip_addresses(): HasMany
    {
        return $this->hasMany(IpAddress::class);

    }
    
}
