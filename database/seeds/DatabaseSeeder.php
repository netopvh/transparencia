<?php

use Illuminate\Database\Seeder;
use App\Models\Access\Role;
use App\Models\Access\User;

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
        $casas =[
            ['name' => 'SESI','created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'SENAI','created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('casas')->insert($casas);


        //Seeder de Usuário
        $user = [
            ['name' => 'Angelo Neto', 'username' => 'angelo.neto', 'email' => 'angelo.neto@fiero.org.br','password' => bcrypt('123456'), 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('users')->insert($user);

        //Seeder de Perfis
        $roles = [
            ['name' => 'Super Administrador', 'all' => true, 'sort' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Administrador', 'all' => false, 'sort' => 2, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Usuário', 'all' => false, 'sort' => 3, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('roles')->insert($roles);

        //Seeder de Permissões
        $permissions = [
            ['name' => 'view-admin', 'display_name' => 'Ver Administração', 'sort' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-users', 'display_name' => 'Gerenciar Usuários', 'sort' => 2, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-roles', 'display_name' => 'Gerenciar Perfis', 'sort' => 3, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'manage-logs', 'display_name' => 'Gerenciar Logs', 'sort' => 4, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('permissions')->insert($permissions);

        $super = Role::find(1);

        $user = User::find(1);
        $user->roles()->attach($super->id);

        $roleAdmin = Role::find(2);
        $roleAdmin->attachPermissions([1,2,3,4]);

        $roleUser = Role::find(3);
        $roleUser->attachPermissions([1,2,3,4]);
    }
}
