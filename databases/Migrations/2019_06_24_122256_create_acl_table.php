<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclTable extends Migration
{

    public function up()
    {
        Schema::create(config('cw_acl.roles_table'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->longText('settings')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_acl.role_user_table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_acl.user_foreign_key'));
            $table->unsignedBigInteger(config('cw_acl.role_foreign_key'));

            $table->foreign(config('cw_acl.user_foreign_key'))
                ->references('id')
                ->on(config('cw_acl.users_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_acl.role_foreign_key'))
                ->references('id')
                ->on(config('cw_acl.roles_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary([config('cw_acl.user_foreign_key'), config('cw_acl.role_foreign_key')]);
        });

        Schema::create(config('cw_acl.permissions_table'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_acl.permission_role_table'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_acl.permission_foreign_key'));
            $table->unsignedBigInteger(config('cw_acl.role_foreign_key'));

            $table->foreign(config('cw_acl.permission_foreign_key'))
                ->references('id')
                ->on(config('cw_acl.permissions_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_acl.role_foreign_key'))
                ->references('id')
                ->on(config('cw_acl.roles_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary([config('cw_acl.permission_foreign_key'), config('cw_acl.role_foreign_key')]);
        });

        if (
            !Schema::hasTable('acl_option_role') &&
            Schema::hasTable('options')
        ) {
            Schema::create('acl_option_role', function (Blueprint $table) {
                $table->unsignedBigInteger('option_id');
                $table->unsignedBigInteger(config('cw_acl.role_foreign_key'));

                $table->foreign('option_id')
                    ->references('id')
                    ->on('options')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign(config('cw_acl.role_foreign_key'))
                    ->references('id')
                    ->on(config('cw_acl.roles_table'))
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->primary(['option_id', config('cw_acl.role_foreign_key')]);
            });
        }

    }

    public function down()
    {
        Schema::dropIfExists('acl_option_role');
        Schema::dropIfExists(config('cw_acl.permission_role_table'));
        Schema::dropIfExists(config('cw_acl.permissions_table'));
        Schema::dropIfExists(config('cw_acl.role_user_table'));
        Schema::dropIfExists(config('cw_acl.roles_table'));
    }
}
