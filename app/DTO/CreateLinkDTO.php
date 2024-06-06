<?php

namespace App\DTO;


class CreateLinkDTO
{
    public function __construct(public $name, public $id,public $postId){}
}
