<?php

namespace App\DTO;

class RegisterDTO
{
    public function __construct(public $name, public $email, public $password){}
}
