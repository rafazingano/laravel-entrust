<?php
namespace ConfrariaWeb\Entrust\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EntrustTableSeeder extends Seeder
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
    }

    private function createRoles()
    {
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrador',
                'description' => 'Administrador do sistema',
                'settings' => NULL
            ]
        ];
        foreach ($roles as $role) {
            DB::table(config('cw_entrust.roles_table'))->insert($role);
        }
    }

    private function truncateTables()
    {
        $this->command->info('Fazendo um truncate nas tabelas entrusts, sai da frente... ;/');
        Schema::disableForeignKeyConstraints();
        DB::table(config('cw_entrust.role_user_table'))->truncate();
        DB::table(config('cw_entrust.permission_role_table'))->truncate();
        DB::table(config('cw_entrust.roles_table'))->truncate();
        DB::table(config('cw_entrust.permissions_table'))->truncate();
        Schema::enableForeignKeyConstraints();
        $this->command->info('Pronto, truncates feitos em entrust, acho que com sucesso :D');
    }
}
