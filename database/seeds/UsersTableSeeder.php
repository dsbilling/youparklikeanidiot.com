<?php

use DPSEI\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            'uuid' => Str::uuid(4),
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::uuid(4),
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('12345678'),
        ]);

        $role = Role::create(['name' => 'write']);
        $permission = Permission::create(['name' => 'edit articles']);

        $role->givePermissionTo($permission);

        $user = User::find(1)->first();
        $user->assignRole('write');
    }
}
