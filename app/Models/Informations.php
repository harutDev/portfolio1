<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    public mixed $id;
    protected $fillable = [
        'about_me',
        'user_id'

    ];
}
