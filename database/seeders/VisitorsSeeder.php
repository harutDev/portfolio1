<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitors;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'admin@admin.com')->first();
        if (!Visitors::query()->where('user_id', $user->id)->first()) {
           Visitors::query()->create([
               'ip_address'=>'103.118.8.0',
               'user_agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
               'referrer'=>'103.118.8.0/login',
               'visit_time'=> Carbon::now(),
               'country_name'=>'Armenia',
               'city'=>'Yerevan',
               'region_name'=>'Yerevan',
               'user_id'=>$user->id
            ]);
        }
    }
}
