<?php

namespace Database\Seeders;

use App\Enum\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(['name'=>'admin','email'=>'admin@admin.ru','password'=>'adminadmin']);
        $user->assignRole([RoleEnum::ADMIN->value]);
    }
}
