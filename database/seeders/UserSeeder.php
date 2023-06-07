<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Academic staff
        $user = new User();
        $user->full_name = "Administrator";
        $user->username = "admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("123");
        $user->level = "ACADEMIC_STAFF";
        $user->save();
    }
}
