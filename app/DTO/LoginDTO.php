<?php

namespace App\DTO;

class LoginDTO
{
    public function __construct(public $email, public $password){}
}
