<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Visitors;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VisitorsSeeder::class,
            EducationsSeeder::class,
            informationsSeeder::class,
            NotificationSeeder::class,
            SkillsSeeder::class,
        ]);
    }
}
