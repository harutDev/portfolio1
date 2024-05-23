<?php

namespace Database\Seeders;

use App\Models\Educations;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'admin@admin.com')->first();
        if (!Educations::query()->where('user_id', $user->id)->first()) {
            for($i = 1; $i < 6; ++$i) {
                Educations::query()->create([
                    'name'=> substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz-:,"),0,8),
                    'user_id' => $user->id
                ]);
           }
        }
    }
}
