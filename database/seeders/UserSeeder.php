<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'abinesilew@gmail.com')->exists()) {
            User::create([
                'name' => 'Abeni',
                'email' => 'abinesilew@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}