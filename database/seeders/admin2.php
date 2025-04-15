<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class admin2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin Armaso', 
            'email' => 'adminarmaso@admin.com', 
            'role' => 'superadmin',
            'password' => Hash::make('pondokembahkung'), 
        ]);
    }
}
