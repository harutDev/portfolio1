<?php

namespace App\DTO;

use Illuminate\Http\Request;

class DeletePostDTO
{

    public function __construct( public $path,public $id){}

//    public function getPostId()
//    {
//        return $this->postId;
//    }
//
//    public function getPath()
//    {
//        return $this->path;
//    }
}
