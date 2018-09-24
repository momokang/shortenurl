<?php

use Illuminate\Database\Seeder;
use \App\Models\User;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@email.com')->exists()) {
            $user = new User;
            $user->name = 'Admin';
            $user->email = 'admin@email.com';
            $user->password = bcrypt('111111');
            $user->save();
        }
    }
}
