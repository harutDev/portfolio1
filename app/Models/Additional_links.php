<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_links extends Model
{
    protected $fillable = [
        'name',
        'post_id'
    ];
}
