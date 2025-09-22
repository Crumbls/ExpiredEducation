<?php

namespace Database\Seeders;

use App\Models\Fact;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Chase',
            'email' => 'chase@crumbls.com'
        ], [
            'password' => bcrypt(md5(__LINE__))
        ]);

        Fact::factory(10)->create();
    }
}
