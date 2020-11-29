<?php

use App\Job;
use App\Role;
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
        Role::create([
            'id' => 1,
            'name' => 'superadmin',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'admin',
        ]);
        Role::create([
            'id' => 3,
            'name' => 'manager',
        ]);
        Role::create([
            'id' => 4,
            'name' => 'member',
        ]);

        $job1 = Job::create([
            'name' => 'Software Engineer',
            'description' => 'A software engineer is a person who applies the principles of software engineering to the design, development, maintenance, testing, and evaluation of computer software.',
        ]);

        $job2 = Job::create([
            'name' => 'Human Resource',
            'description' => 'Human resource management (HRM or HR) is the strategic approach to the effective management of people in a company or organization such that they help their business gain a competitive advantage.',
        ]);

        $user = User::where('email','oponechukwuyenum@gmail.com')->first();
        if (!$user) {
            User::create([
                'id' => 10000001,
                'name' => 'Opone Yenum',
                'email' => 'oponechukwuyenum@gmail.com',
                'role_id' => 1,
                'job_id' => 1,
                'password' => Hash::make('password')
            ]);
        }

        $user1 = User::where('email','mr.tunmise@gmail.com')->first();
        if (!$user1) {
            User::create([
                'name' => 'Daniel Ebitunmise',
                'email' => 'mr.tunmise@gmail.com',
                'role_id' => 1,
                'job_id' => 2,
                'password' => Hash::make('password')
            ]);
        }
    }
}
