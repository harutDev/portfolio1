<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitors extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'referrer',
        'visit_time',
        'country_name',
        'city',
        'region_name',
        'user_id'
    ];
    public function notification(): HasMany
    {
        return $this->hasMany(Notification::class,'visitor_id','id');
    }
}
