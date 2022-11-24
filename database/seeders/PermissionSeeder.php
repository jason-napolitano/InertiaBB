<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // users
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'restore_user']);
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'update_user']);
        Permission::create(['name' => 'delete_user']);

        // forums
        Permission::create(['name' => 'manage_forums']);
        Permission::create(['name' => 'manage_forum']);
        Permission::create(['name' => 'update_forum']);
        Permission::create(['name' => 'delete_forum']);
        Permission::create(['name' => 'create_forum']);

        // threads
        Permission::create(['name' => 'manage_threads']);
        Permission::create(['name' => 'manage_thread']);
        Permission::create(['name' => 'update_thread']);
        Permission::create(['name' => 'delete_thread']);
        Permission::create(['name' => 'create_thread']);

        // threads
        Permission::create(['name' => 'manage_posts']);
        Permission::create(['name' => 'manage_post']);
        Permission::create(['name' => 'update_post']);
        Permission::create(['name' => 'delete_post']);
        Permission::create(['name' => 'create_post']);

        // likes
        Permission::create(['name' => 'toggle_like']);

        // dashboard
        Permission::create(['name' => 'view_dashboard']);

        // admin wildcard for the client application
        // @see resources/js/Utils/index.js -> can()
        Permission::create(['name' => '*']);

        // --------------------------------------------
        // regular member
        $member = Role::create(['name' => 'member']);

        // forums
        $member->givePermissionTo('manage_forum');
        $member->givePermissionTo('update_forum');
        $member->givePermissionTo('delete_forum');
        $member->givePermissionTo('create_forum');

        // threads
        $member->givePermissionTo('manage_thread');
        $member->givePermissionTo('update_thread');
        $member->givePermissionTo('delete_thread');
        $member->givePermissionTo('create_thread');

        // posts
        $member->givePermissionTo('manage_post');
        $member->givePermissionTo('update_post');
        $member->givePermissionTo('delete_post');
        $member->givePermissionTo('create_post');

        // likes
        $member->givePermissionTo('toggle_like');

        // create user
        $user = User::factory()->create([
            'name'     => 'Jeremiah Livingston',
            'password' => bcrypt('member'),
            'email'    => 'member@example.com',
            'username' => 'member',
        ]);
        $user->assignRole($member);

        // --------------------------------------------
        // moderator
        $moderator = Role::create(['name' => 'moderator']);

        // forums
        $moderator->givePermissionTo('view_dashboard');
        $moderator->givePermissionTo('manage_threads');
        $moderator->givePermissionTo('manage_forums');
        $moderator->givePermissionTo('manage_posts');
        $moderator->givePermissionTo('toggle_like');

        // create user
        $user = User::factory()->create([
            'password' => bcrypt('moderator'),
            'email'    => 'moderator@example.com',
            'name'     => 'Isaac Horstead',
            'username' => 'moderator',
        ]);
        $user->assignRole($moderator);

        // --------------------------------------------
        // administrator
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('*');
        $user = User::factory()->create([
            'password' => bcrypt('administrator'),
            'email'    => 'administrator@example.com',
            'name'     => 'Joshua McDonald',
            'username' => 'administrator',
        ]);
        $user->assignRole($admin);
    }
}
