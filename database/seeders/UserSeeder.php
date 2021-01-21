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
        User::create([
            'name' => 'Jose Antonio Calderon Garcia',
            'email' => 'antonio.tics.23@gmail.com',
            'password' => bcrypt('1234567')
        ]);

        User::factory(99)->create();
    }
}
