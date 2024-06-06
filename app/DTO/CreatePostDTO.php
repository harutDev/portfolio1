<?php

namespace App\DTO;


class CreatePostDTO
{
    public function __construct(public $image,public $links,public $id){}
}
