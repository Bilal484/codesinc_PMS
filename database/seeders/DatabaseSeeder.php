<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ShieldSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@pms.test',
        ]);
        $admin->assignRole('super_admin');

        $pm = User::factory()->create([
            'name' => 'Project Manager',
            'email' => 'pm@pms.test',
        ]);
        $pm->assignRole('project_manager');

        $employee = User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@pms.test',
        ]);
        $employee->assignRole('employee');
    }
}
