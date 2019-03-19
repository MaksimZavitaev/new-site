<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@soglasie.local',
            'password' => '$2y$10$PBir1X.aCrlK5QaVoRW1je6ioV55AMm.X8EeYeViiO65Iu6IYu5lG', // secret
            'remember_token' => Str::random(10),
        ])->syncRoles('administrator');
    }
}
