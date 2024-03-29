<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
            ],
            [
                'id' => 2,
                'name' => 'Keuangan',
            ],
            [
                'id' => 3,
                'name' => 'Reviewer',
            ],
            [
                'id' => 4,
                'name' => 'Author',
            ],
            [
                'id' => 5,
                'name' => 'Editor',
            ],
        ]);
    }
}
