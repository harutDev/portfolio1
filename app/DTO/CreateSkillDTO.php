<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateSkillDTO
{


    public function __construct(public $name,public $id){}

//    public function getName(): string
//    {
//        return $this->name;
//    }
//
//    public function getUserId(): int
//    {
//        return $this->userId;
//    }
}
