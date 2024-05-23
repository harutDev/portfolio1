<?php

namespace App\DTO;

class UpdateLinkDTO
{
    public function __construct(public $postId,public $name,public $id){}
}
