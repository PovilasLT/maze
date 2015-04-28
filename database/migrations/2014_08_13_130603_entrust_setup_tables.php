<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the roles table
        Schema::create('roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Creates the assigned_roles (Many-to-Many relation) table
        Schema::create('assigned_roles', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // Creates the permissions table
        Schema::create('permissions', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions'); // assumes a users table
            $table->foreign('role_id')->references('id')->on('roles');
        });

        $this->setupFoundorAndBaseRolsPermission();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table('assigned_roles', function (Blueprint $table) {
            $table->dropForeign('assigned_roles_user_id_foreign');
            $table->dropForeign('assigned_roles_role_id_foreign');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::drop('assigned_roles');
        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
    }

    public function setupFoundorAndBaseRolsPermission() 
    {

        //use this to set up admin accounts

        // Create Roles
        $founder = new Role;
        $founder->name = 'Įkūrėjas';
        $founder->save();

        $admin = new Role;
        $admin->name = 'Administratorius';
        $admin->save();

        $mod = new Role;
        $mod->name = 'Moderatorius';
        $mod->save();

        $premium = new Role;
        $premium->name = 'Premium Narys';
        $premium->save();

        $member = new Role;
        $member->name = 'Narys';
        $member->save();

        // Create Permissions
        $manageTopics = new Permission;
        $manageTopics->name = 'manage_topics';
        $manageTopics->display_name = 'Manage Topics';
        $manageTopics->save();

        $manageStatuses = new Permission;
        $manageStatuses->name = 'manage_statuses';
        $manageStatuses->display_name = 'Manage Status Updates';
        $manageStatuses->save();

        $manageComments = new Permission;
        $manageComments->name = 'manage_comments';
        $manageComments->display_name = 'Manage Comments';
        $manageComments->save();

        $manageUsers = new Permission;
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->save();

        // Assign Permission to Role
        $founder->perms()->sync([$manageTopics->id,$manageUsers->id,$manageStatuses->id, $manageComments->id]);
        $admin->perms()->sync([$manageTopics->id,$manageUsers->id,$manageStatuses->id]);

    }
}
