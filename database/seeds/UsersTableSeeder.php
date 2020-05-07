<?php

use App\User;
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
        $user = User::where('email','oponechukwuyenum@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'Opone Yenum',
                'email' => 'oponechukwuyenum@gmail.com',
                'role' => 'superadmin',
                'password' => Hash::make('password')
            ]);
        }

        $user1 = User::where('email','ebitunmise@gmail.com')->first();
        if (!$user1) {
            User::create([
                'name' => 'Ebitunmise Daniel',
                'email' => 'ebitunmise@gmail.com',
                'role' => 'superadmin',
                'password' => Hash::make('password')
            ]);
        }
    }
}
