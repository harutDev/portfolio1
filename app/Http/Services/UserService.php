<?php

namespace App\Http\Services;

use App\DTO\UserUpdateDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\User;

class UserService implements ViewInterface, ColumnsInterface
{
    public function updateUser(UserUpdateDTO $userDTO): void
    {
        User::query()->where('id', $userDTO->id)->update([
            self::NAME => $userDTO->name,
            self::SURNAME => $userDTO->surname,
            self::ADDRESS => $userDTO->address,
            self::PHONE => $userDTO->phone,
            self::AGE => $userDTO->age,
            self::LANGUAGES => $userDTO->languages,
        ]);
    }
}
