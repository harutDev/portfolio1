<?php

namespace App\DTO;

class UserUpdateDTO
{


    public function __construct(public $id, public $name, public $surname, public $address, public $phone, public $age, public $languages)
    {

    }
}
