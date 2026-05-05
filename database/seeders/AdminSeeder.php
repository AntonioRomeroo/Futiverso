<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@futiverso.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]   
        );
    }
}
