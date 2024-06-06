<?php

namespace App\DTO;

class UpdatePostDTO
{
    public function __construct(public $image,public $links,public $id){}
}
