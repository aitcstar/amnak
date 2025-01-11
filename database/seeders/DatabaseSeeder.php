<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
class DatabaseSeeder extends Seeder
{
    public function run()
    {

        Role::create(['id' => 1 ,'name' => 'admin']);
        User::create([
                'name' => "Admin",
                'email' => "admin@admin.com",
                'password' => bcrypt('12345678'),
                'role_id' => 1
        ]);
        Setting::insert([
            [
                'key' => "ambulance",
                'value' => "123456",
            ]
        ]);
    }
}
