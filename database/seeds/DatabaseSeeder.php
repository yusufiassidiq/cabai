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
        ]);        
        User::create([
            'name' => 'Produsen',
            'email' => 'produsen@test.com',
            'password' => Hash::make('asd'),
            'role' => 2,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);
        User::create([
            'name' => 'Pengepul',
            'email' => 'pengepul@test.com',
            'password' => Hash::make('asd'),
            'role' => 3,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);
        User::create([
            'name' => 'Grosir',
            'email' => 'grosir@test.com',
            'password' => Hash::make('asd'),
            'role' => 4,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);
        User::create([
            'name' => 'Pengecer',
            'email' => 'pengecer@test.com',
            'password' => Hash::make('asd'),
            'role' => 5,
            'status' => 1,
            'fotosk' => Str::random(5)
        ]);
    }
}
