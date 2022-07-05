<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'username' => 'Jose',
            'lastname' => 'Ramirez',
            'location' => 'tunkas',
            'password' => '12345'
        ]);
        Author::create([
            'username' => 'Pedro',
            'lastname' => 'Chan',
            'location' => 'Izamal',
            'password' => '12345'
        ]);
        Author::create([
            'username' => 'Joana',
            'lastname' => 'Chi',
            'location' => 'sotuta',
            'password' => '12345'
        ]);
        Author::create([
            'username' => 'Luis',
            'lastname' => 'Can',
            'location' => 'Citilcun',
            'password' => '12345'
        ]);
    }
}
