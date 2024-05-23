<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::query()->where('email', 'admin@admin.com')->first()) {
            User::query()->create([
                'email' => 'admin@admin.com',
                'name' => 'Admin',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt(config('app.admin_password')),
                'address'=>'Address',
                'phone'=>'+374777777',
                'age'=>'18',
                'gender'=>'Other',
                'languages'=>'English',
                'surname'=>'Admin'
            ]);
        }
    }
}
