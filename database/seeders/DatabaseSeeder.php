<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Foto;
use App\Models\Album;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0 = 0');
        DB::table('foto')->delete();
        DB::table('album')->delete();
        DB::table('users')->delete();

        $this->call([
            UserSeeder::class,
        ]);
        $this->call([
            AlbumSeeder::class,
        ]);
        $this->call([
            FotoSeeder::class,
        ]);

    }
}
