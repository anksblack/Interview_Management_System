<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ModulesTableSeeder;
use Database\Seeders\RoleUserTableSeeder;
use Database\Seeders\PermissionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UsersTableSeeder::class,
        RolesTableSeeder::class,
        ModulesTableSeeder::class,
        PermissionsTableSeeder::class,
        RoleUserTableSeeder::class,
        ]);
    }
}
