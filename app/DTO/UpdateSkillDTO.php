<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateSkillDTO
{


    public function __construct(public $id,public $name){}

//    public function getId(): int
//    {
//        return $this->id;
//    }
//
//    public function getName(): string
//    {
//        return $this->name;
//    }
}