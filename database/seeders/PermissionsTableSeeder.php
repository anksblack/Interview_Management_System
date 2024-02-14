<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['access' => 'View', 'description' => 'View permission', 'module_id' => 1],
            ['access' => 'Create', 'description' => 'Create permission', 'module_id' => 1],
            ['access' => 'Update', 'description' => 'Update permission', 'module_id' => 1],
            ['access' => 'Delete', 'description' => 'Delete permission', 'module_id' => 1],
            ['access' => 'Handle', 'description' => 'Handle permission', 'module_id' => 1],
        ]);
    }
}
