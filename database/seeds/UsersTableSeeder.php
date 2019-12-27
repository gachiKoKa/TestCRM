<?php

use App\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $adminRole = UserRole::where('name', 'admin')->first();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(12345678),
            'role_id' => $adminRole->id,
            'company_id' => null
        ]);
    }
}
