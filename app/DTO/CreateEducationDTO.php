<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateEducationDTO
{


    public function __construct(public $education,public $id){}

//    public function getEducation(): string
//    {
//        return $this->education;
//    }
//
//    public function getUserId(): int
//    {
//        return $this->userId;
//    }
}
