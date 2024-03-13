<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Role::where('name', 'Owner')->firstOrCreate(['name' => 'Owner']);
        $manager = Role::where('name', 'Managers')->firstOrCreate(['name' => 'Managers']);
        $cashier = Role::where('name', 'Cashiers')->firstOrCreate(['name' => 'Cashiers']);


        $User1 = User::create([
            'name' => 'Jhone Doe',
            'email' => 'Jone@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $User1->assignRole($owner);

        $User2 = User::create([
            'name' => 'Peter Paker',
            'email' => 'peter@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $User2->assignRole($manager);

        $User3 = User::create([
            'name' => 'Gourge Bernard',
            'email' => 'gourge@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $User3->assignRole($cashier);

    }
}
