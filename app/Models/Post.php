<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    protected $fillable = [
        'image_name',
        'image_pate',
        'links',
        'image_full_path',
        'user_id',
    ];

    public function additionalLinks(): HasMany
    {
        return $this->hasMany(Additional_links::class,'post_id','id');
    }
}
