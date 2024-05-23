<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreatePostDTO
{


    public function __construct(public $image,public $links,public $id){}


}
