<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('asd'),
            'role' => 1,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('asd'),
            'role' => 2,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);
    }
}
