<?php

namespace App\Http\Services;

use App\DTO\CreateAboutMeDTO;
use App\DTO\UpdateAboutMeDTO;
use App\DTO\UserUpdateDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Informations;
use App\Models\User;

class InformationsService implements ViewInterface, ColumnsInterface
{
    public function updateAboutMe(UpdateAboutMeDTO $updateAboutMeDTO): void
    {
        Informations::query()->where('id', $updateAboutMeDTO->id)->update([
            self::ABOUT_ME => $updateAboutMeDTO->aboutMe
        ]);
    }
    public function createAboutMe(CreateAboutMeDTO $createAboutMeDTO): void
    {
        $informations = new Informations();
        $informations->about_me = $createAboutMeDTO->aboutMe;
        $informations->id = $createAboutMeDTO->id;
        $informations->save();
    }
}
