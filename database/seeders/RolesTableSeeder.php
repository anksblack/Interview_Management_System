<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'IsAdmin'],
            ['name' => 'Interviewer', 'description' => 'IsInterviewer'],
            ['name' => 'Candidate', 'description' => 'IsCandidate'],
        ]);
    }
}
