<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstName' => 'Antonije',
                'lastName' => 'Knezevic',
                'email' => 'antonijek@yahoo.com',
                'password' => bcrypt('12345678'),
                'isAdmin'=>1
            ],
            [
                'firstName' => 'Ana',
                'lastName' => 'Jovanovic',
                'email' => 'ana@yahoo.com',
                'password' => bcrypt('12345678'),
                'isAdmin'=>0
            ],
            [
                'firstName' => 'Petar',
                'lastName' => 'Petrovic',
                'email' => 'petar@yahoo.com',
                'password' => bcrypt('12345678'),
                'isAdmin'=>0
            ],
            [
                'firstName' => 'Marko',
                'lastName' => 'Markovic',
                'email' => 'marko@yahoo.com',
                'password' => bcrypt('12345678'),
                'isAdmin'=>0
            ],
            [
                'firstName' => 'Ivana',
                'lastName' => 'Ivanic',
                'email' => 'ivana@yahoo.com',
                'password' => bcrypt('12345678'),
                'isAdmin'=>0
            ],
        ]);

       // $this->run1();
    }

    public function run1(): void
    {
        User::factory(10)->create();
    }

}
