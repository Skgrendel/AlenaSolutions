<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermisosSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(PersonalSeeder::class);
         $this->call(UserSeeder::class);
        $this->call(EncabezadoSeeder::class);
        $this->call(EncabezadosPreguntaSeeder::class);
        $this->call(EncabezadoDetSeeder::class);
        $this->call(CalificacionSeeder::class);

    }
}
