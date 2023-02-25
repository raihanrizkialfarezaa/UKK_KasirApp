<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $defval = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        $admin = User::create(array_merge([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
        ], $defval));
        $manajer = User::create(array_merge([
            'email' => 'manajer@gmail.com',
            'name' => 'manajer',
        ], $defval));
        $kasir = User::create(array_merge([
            'email' => 'kasir@gmail.com',
            'name' => 'kasir',
        ], $defval));

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'manajer']);
        $role = Role::create(['name' => 'kasir']);

        $permission = Permission::create(['name' => 'do_transaction']);
        $permission = Permission::create(['name' => 'see_private_transaction']);
        $permission = Permission::create(['name' => 'see_all_transaction']);
        $permission = Permission::create(['name' => 'change_payment']);
        $permission = Permission::create(['name' => 'print_invoice']);
        $permission = Permission::create(['name' => 'check_table_number']);
        $permission = Permission::create(['name' => 'check_most']);
        $permission = Permission::create(['name' => 'crud_user']);
        $permission = Permission::create(['name' => 'crud_menu']);
        $permission = Permission::create(['name' => 'crud_table']);

        $admin->givePermissionTo('crud_user');
        $admin->givePermissionTo('crud_menu');
        $admin->givePermissionTo('crud_table');
        $manajer->givePermissionTo('see_all_transaction');
        $manajer->givePermissionTo('check_most');
        $kasir->givePermissionTo('change_payment');
        $kasir->givePermissionTo('do_transaction');
        $kasir->givePermissionTo('see_private_transaction');
        $kasir->givePermissionTo('check_table_number');
        $kasir->givePermissionTo('print_invoice');

        $admin->assignRole('admin');
        $manajer->assignRole('manajer');
        $kasir->assignRole('kasir');
    }
}
