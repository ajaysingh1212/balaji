<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;

class UserSeeder extends Seeder
{

public function run(): void
{

/*
Create Roles
*/

$superAdmin = Role::firstOrCreate([
'name' => 'Super Admin',
'slug' => 'super-admin'
], [
'name' => 'Super Admin',
'slug' => 'super-admin'
]);

$admin = Role::firstOrCreate([
'name' => 'Admin',
'slug' => 'admin'
], [
'name' => 'Admin',
'slug' => 'admin'
]);

$userRole = Role::firstOrCreate([
'name' => 'User',
'slug' => 'user'
], [
'name' => 'User',
'slug' => 'user'
]);


/*
Create Users
*/

$superAdminUser = User::firstOrCreate([
'email' => 'superadmin@gmail.com',
], [
'name' => 'Super Admin',
'email' => 'superadmin@gmail.com',
'password' => Hash::make('12345678')
]);

$adminUser = User::firstOrCreate([
'email' => 'admin@gmail.com',
], [
'name' => 'Admin',
'email' => 'admin@gmail.com',
'password' => Hash::make('12345678')
]);

$normalUser = User::firstOrCreate([
'email' => 'user@gmail.com',
], [
'name' => 'User',
'email' => 'user@gmail.com',
'password' => Hash::make('12345678')
]);


/*
Assign Roles
*/

$superAdminUser->roles()->sync([$superAdmin->id]);

$adminUser->roles()->sync([$admin->id]);

$normalUser->roles()->sync([$userRole->id]);

}
}
