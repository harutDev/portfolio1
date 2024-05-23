<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateAboutMeDTO
{
    public function __construct(public $aboutMe, public $id) {}
}
