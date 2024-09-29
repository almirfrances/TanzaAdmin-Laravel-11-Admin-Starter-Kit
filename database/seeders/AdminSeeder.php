<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Tanza',
            'last_name' => 'Admin',
            'username' => 'tanzaadmin',
            'email' => 'tanzaadmin@example.com',
            'profile' => 'default-profile.png',
            'password' => Hash::make('tanzahost'),
        ]);
    }
}
