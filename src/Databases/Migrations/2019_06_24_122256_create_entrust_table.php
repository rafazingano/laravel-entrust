<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrustTable extends Migration
{

    public function up()
    {
        Schema::create('entrust_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->longText('settings')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('entrust_role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('entrust_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        Schema::create('entrust_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('entrust_permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on('entrust_permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('entrust_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('option_role', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('option_id')
                ->references('id')
                ->on('options')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('entrust_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['option_id', 'role_id']);
        });

    }

    public function down()
    {
        Schema::dropIfExists('option_role');
        Schema::dropIfExists('entrust_permission_role');
        Schema::dropIfExists('entrust_permissions');
        Schema::dropIfExists('entrust_role_user');
        Schema::dropIfExists('entrust_roles');
    }
}
