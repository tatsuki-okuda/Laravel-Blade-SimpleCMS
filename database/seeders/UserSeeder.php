<?php
 
namespace Database\Seeders;
 
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
        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'yamada',
                'email' => 'yamada@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'tanaka',
                'email' => 'tanaka@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}