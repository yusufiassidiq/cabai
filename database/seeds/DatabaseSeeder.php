<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Lokasi;
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
        // User::create([
        //     'name' => 'Produsen',
        //     'email' => 'produsen@test.com',
        //     'password' => Hash::make('asd'),
        //     'role' => 2,
        //     'status' => 1,
        //     'fotosk' => Str::random(5)
        // ]);
        // User::create([
        //     'name' => 'Pengepul',
        //     'email' => 'pengepul@test.com',
        //     'password' => Hash::make('asd'),
        //     'role' => 3,
        //     'status' => 1,
        //     'fotosk' => Str::random(5)
        // ]);
        // User::create([
        //     'name' => 'Grosir',
        //     'email' => 'grosir@test.com',
        //     'password' => Hash::make('asd'),
        //     'role' => 4,
        //     'status' => 1,
        //     'fotosk' => Str::random(5)
        // ]);
        // User::create([
        //     'name' => 'Pengecer',
        //     'email' => 'pengecer@test.com',
        //     'password' => Hash::make('asd'),
        //     'role' => 5,
        //     'status' => 1,
        //     'fotosk' => Str::random(5)
        // ]);
        $user = new User;
        $user->name = "Produsen";
        $user->email = "produsen@test.com";
        $user->password = Hash::make('asd');
        $user->role = 2;
        $user->status = 1;
        $user->fotosk = Str::random(5);
        $user->save();
        $lokasi = new Lokasi([
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bogor Barat',
            'kelurahan' => 'Balumbang Jaya',
            'user_id'=>$user->id
        ]);
        $lokasi->user()->associate($user);
        $lokasi->save();

        $user = new User;
        $user->name = "Pengepul";
        $user->email = "pengepul@test.com";
        $user->password = Hash::make('asd');
        $user->role = 3;
        $user->status = 1;
        $user->fotosk = Str::random(5);
        $user->save();
        $lokasi = new Lokasi([
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bogor Barat',
            'kelurahan' => 'Balumbang Jaya',
            'user_id'=>$user->id
        ]);
        $lokasi->user()->associate($user);
        $lokasi->save();

        $user = new User;
        $user->name = "Grosir";
        $user->email = "grosir@test.com";
        $user->password = Hash::make('asd');
        $user->role = 4;
        $user->status = 1;
        $user->fotosk = Str::random(5);
        $user->save();
        $lokasi = new Lokasi([
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bogor Barat',
            'kelurahan' => 'Balumbang Jaya',
            'user_id'=>$user->id
        ]);
        $lokasi->user()->associate($user);
        $lokasi->save();

        $user = new User;
        $user->name = "Pengecer";
        $user->email = "pengecer@test.com";
        $user->password = Hash::make('asd');
        $user->role = 5;
        $user->status = 1;
        $user->fotosk = Str::random(5);
        $user->save();
        $lokasi = new Lokasi([
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bogor Barat',
            'kelurahan' => 'Balumbang Jaya',
            'user_id'=>$user->id
        ]);
        $lokasi->user()->associate($user);
        $lokasi->save();
    }
}
