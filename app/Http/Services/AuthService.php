<?php

namespace App\Http\Services;

use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService implements ViewInterface, ColumnsInterface
{
    public function login(LoginDTO $loginDTO): void
    {

        $user = User::where('email', $loginDTO->email)->first();
        Auth::login($user);


    }
    public function registration(RegisterDTO $registerDTO): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = new User([
            self::NAME => $registerDTO->name,
            self::EMAIL => $registerDTO->email,
            self::PASSWORD => bcrypt($registerDTO->password),
            self::EMAIL_VERIFIED_AT => Carbon::now()
        ]);

        if ($user->save()) {
            $user->createToken('Token Name')->accessToken;
            Auth::login($user);

            return redirect()->route(self::VIEW_LOGIN);
        }
        else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }
}
