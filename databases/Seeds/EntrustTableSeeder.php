<?php
namespace ConfrariaWeb\Entrust\Databases\Seeds;

use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->createRoles();
        $this->createPermissions();
    }

    private function createRoles()
    {
        $roles_table = config('cw_entrust.roles_table');
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrador',
                'description' => 'Administrador do sistema',
                'settings' => NULL
            ],
            [
                'name' => 'guest',
                'display_name' => 'Convidado',
                'description' => 'Convidado do sistema',
                'settings' => NULL
            ],
        ];
        foreach ($roles as $role) {
            if (DB::table($roles_table)->where('name', $role['name'])->doesntExist()) {
                DB::table($roles_table)->insert($role);
            }
        }
    }

    private function createPermissions()
    {
        $permissions_table = config('cw_entrust.permissions_table');
        $permissions = [
            [
                'name' => 'admin.roles.index',
                'display_name' => 'Lista de perfis',
                'description' => 'Lista de perfis',
            ],
            [
                'name' => 'admin.roles.create',
                'display_name' => 'Criar perfil',
                'description' => 'Criar perfil',
            ],
            [
                'name' => 'admin.roles.show',
                'display_name' => 'Ver perfil',
                'description' => 'Ver perfil',
            ],
            [
                'name' => 'admin.roles.edit',
                'display_name' => 'Editar perfil',
                'description' => 'Editar perfil',
            ],
            [
                'name' => 'admin.roles.destroy',
                'display_name' => 'Deletar perfil',
                'description' => 'Deletar perfil',
            ],
        ];
        foreach ($permissions as $permission) {
            if (DB::table($permissions_table)->where('name', $permission['name'])->doesntExist()) {
                DB::table($permissions_table)->insert($permission);
            }
        }
    }

    private function truncateTables()
    {
        //if ($this->command->confirm('Deseja truncar todas as tabelas referentes ao entrust?')) {
            $this->command->info('Fazendo um truncate nas tabelas entrusts, sai da frente... ;/');
            Schema::disableForeignKeyConstraints();
            DB::table(config('cw_entrust.role_user_table'))->truncate();
            DB::table(config('cw_entrust.permission_role_table'))->truncate();
            DB::table(config('cw_entrust.roles_table'))->truncate();
            DB::table(config('cw_entrust.permissions_table'))->truncate();
            Schema::enableForeignKeyConstraints();
            $this->command->info('Pronto, truncates feitos em entrust, acho que com sucesso :D');
        //}
    }
}
