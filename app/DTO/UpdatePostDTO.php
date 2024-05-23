<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdatePostDTO
{
    public function __construct(public $image,public $links,public $id){}

//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function getLinks()
//    {
//        return $this->links;
//    }
//
//    public function getImage(): array|UploadedFile|null
//    {
//        return $this->image;
//    }
//
//    public function hasImage(): bool
//    {
//        return $this->hasImage;
//    }

}
