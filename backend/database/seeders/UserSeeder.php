<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persona = Persona::create([
            'dni' => '11222333',
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'telefono' => '3794 112233',
            'email' => 'empleado@example.com',
            'direccion' => '',
        ]);
        //Empleado Administrador Area SECRETARIA GENERAL ADMINISTRATIVA
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'20'.$persona->dni.'4',
            'tipo_user_id' => 1,
            'area_id' => 2,
            'area_type' => 'App\Models\Area',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
            'dni' => '21928192',
            'nombre' => 'Marta Mabel',
            'apellido' => 'Perez',
            'telefono' => '3794 112233',
            'email' => 'empleado2@example.com',
            'direccion' => '',
        ]);


        //Empleado Administrador Area Mesa Entrada
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'20'.$persona->dni.'0',
            'tipo_user_id' => 1,
            'area_id' => 2,
            'area_type' => 'App\Models\Area',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
            'dni' => '23742249',
            'nombre' => 'Jose Antonio',
            'apellido' => 'Terraes',
            'telefono' => '3794 112233',
            'email' => 'empleado5@example.com',
            'direccion' => '',
        ]);

        //Empleado SubArea : Dpto. MESA DE ENTRADAS Y SALIDAS
        User::create([
            'persona_id' => $persona->id,
            'cuil'=>'27'.$persona->dni.'2',
            'tipo_user_id' => 2,
            'area_id' => 6,
            'area_type' => 'App\Models\SubArea',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $persona = Persona::create([
        'dni' => '10123455',
        'nombre' => 'Ramon',
        'apellido' => 'Fernandez',
        'telefono' => '3794 112233',
        'email' => 'empleado4@example.com',
        'direccion' => '',
    ]);

    //Empleado SubArea : Dpto. CONTABLE
    User::create([
        'persona_id' => $persona->id,
        'cuil'=>'20'.$persona->dni.'4',
        'tipo_user_id' => 2,
        'area_id' => 8,
        'area_type' => 'App\Models\SubArea',
        'email_verified_at' => now(),
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
    ]);
    }
}
