<?php

use Illuminate\Database\Seeder;
use App\Models\Access\Role;
use App\Models\Access\User;
use App\Models\Estado;
Use App\Models\Cidade;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeder de Casas
        $casas = [
            ['name' => 'SESI', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'SENAI', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('casas')->insert($casas);


        //Seeder de Usuário
        $user = [
            ['name' => 'Angelo Neto', 'username' => 'angelo.neto', 'email' => 'angelo.neto@fiero.org.br', 'password' => bcrypt('123456'), 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('users')->insert($user);

        //Seeder de Perfis
        $roles = [
            ['name' => 'Super Administrador', 'sort' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('roles')->insert($roles);

        //Seeder de Permissões
        $permissions = [
            ['name' => 'view-admin', 'display_name' => 'Ver Administração', 'sort' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-users', 'display_name' => 'Gerenciar Usuários', 'sort' => 2, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-roles', 'display_name' => 'Gerenciar Perfis', 'sort' => 3, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-logs', 'display_name' => 'Gerenciar Logs', 'sort' => 4, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-orc', 'display_name' => 'Gerenciar Orçamento', 'sort' => 5, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-cont', 'display_name' => 'Gerenciar Contabilidade', 'sort' => 6, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-integri', 'display_name' => 'Gerenciar Integridade', 'sort' => 7, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-infra', 'display_name' => 'Gerenciar Infraestrutura', 'sort' => 8, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-rh', 'display_name' => 'Gerenciar Itens RH', 'sort' => 9, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-sac', 'display_name' => 'Gerenciar SAC', 'sort' => 10, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('permissions')->insert($permissions);

        $super = Role::find(1);

        $super->attachPermissions([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $user = User::find(1);
        $user->roles()->attach($super->id);

    }
}