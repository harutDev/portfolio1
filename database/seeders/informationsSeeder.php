<?php

namespace Database\Seeders;

use App\Models\informations;
use App\Models\User;
use Illuminate\Database\Seeder;

class informationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'admin@admin.com')->first();
        if (!informations::query()->where('user_id', $user->id)->first()) {
            informations::query()->create([
                'about_me'=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
                'user_id' => $user->id
            ]);
        }

    }
}
