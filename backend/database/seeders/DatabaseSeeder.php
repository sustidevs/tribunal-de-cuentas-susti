<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TipoEntidadSeeder::class,
            TipoUserSeeder::class,
            IniciadorSeeder::class,
            TipoExpedienteSeeder::class,
            SubAreaSeeder::class,
            PrioridadExpedienteSeeder::class,
            EstadoExpedienteSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            DatosPruebasSeeder::class,
        ]);
    }
}
