<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
           'name' => 'admin',
        ]);
        DB::table('user_roles')->insert([
            'name' => 'employee',
        ]);
    }
}
