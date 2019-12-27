<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
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
