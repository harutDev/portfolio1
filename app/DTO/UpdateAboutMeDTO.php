<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateAboutMeDTO
{


    public function __construct(public $aboutMe, public $id){}

}
