<?php

namespace Database\Seeders;

use App\Models\Skills;
use App\Models\User;
use App\Models\Visitors;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'admin@admin.com')->first();
        if (!Skills::query()->where('user_id', $user->id)->first()) {
            Skills::query()->create([
                'name' => 'Js',
                'user_id' => $user->id
            ]);
            Skills::query()->create([
                'name' => 'Php',
                'user_id' => $user->id
            ]);
            Skills::query()->create([
                'name' => 'C#',
                'user_id' => $user->id
            ]);
        }

    }
}

