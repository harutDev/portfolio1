<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateLinkDTO
{


    public function __construct(public $name, public $id,public $postId){}

//    public function getName(): string
//    {
//        return $this->name;
//    }
//
//    public function getPostId(): int
//    {
//        return $this->postId;
//    }
}
