<?php

namespace Database\Seeders;

use App\Models\Userall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Userall::factory(10)->create();
    }
}
