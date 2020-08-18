<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrustTable extends Migration
{

    public function up()
    {
        Schema::create(config('cw_entrust.roles_table'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->longText('settings')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_entrust.role_user_table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_entrust.user_foreign_key'));
            $table->unsignedBigInteger(config('cw_entrust.role_foreign_key'));

            $table->foreign(config('cw_entrust.user_foreign_key'))
                ->references('id')
                ->on(config('cw_entrust.users_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_entrust.role_foreign_key'))
                ->references('id')
                ->on(config('cw_entrust.roles_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary([config('cw_entrust.user_foreign_key'), config('cw_entrust.role_foreign_key')]);
        });

        Schema::create(config('cw_entrust.permissions_table'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_entrust.permission_role_table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_entrust.permission_foreign_key'));
            $table->unsignedBigInteger(config('cw_entrust.role_foreign_key'));

            $table->foreign(config('cw_entrust.permission_foreign_key'))
                ->references('id')
                ->on(config('cw_entrust.permissions_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_entrust.role_foreign_key'))
                ->references('id')
                ->on(config('cw_entrust.roles_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary([config('cw_entrust.permission_foreign_key'), config('cw_entrust.role_foreign_key')]);
        });

        if (
            !Schema::hasTable('entrust_option_role') && 
            Schema::hasTable('options')
        ) {
            Schema::create('entrust_option_role', function (Blueprint $table) {
                $table->unsignedBigInteger('option_id');
                $table->unsignedBigInteger(config('cw_entrust.role_foreign_key'));

                $table->foreign('option_id')
                    ->references('id')
                    ->on('options')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign(config('cw_entrust.role_foreign_key'))
                    ->references('id')
                    ->on(config('cw_entrust.roles_table'))
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->primary(['option_id', config('cw_entrust.role_foreign_key')]);
            });
        }

    }

    public function down()
    {
        Schema::dropIfExists('entrust_option_role');
        Schema::dropIfExists(config('cw_entrust.permission_role_table'));
        Schema::dropIfExists(config('cw_entrust.permissions_table'));
        Schema::dropIfExists(config('cw_entrust.role_user_table'));
        Schema::dropIfExists(config('cw_entrust.roles_table'));
    }
}
