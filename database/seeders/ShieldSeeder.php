<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view_project', 'view_any_project', 'create_project', 'update_project', 'delete_project', 'restore_project',
            'view_task', 'view_any_task', 'create_task', 'update_task', 'delete_task', 'restore_task',
            'view_milestone', 'view_any_milestone', 'create_milestone', 'update_milestone', 'delete_milestone', 'restore_milestone',
            'view_time::entry', 'view_any_time::entry', 'create_time::entry', 'update_time::entry', 'delete_time::entry',
            'view_label', 'view_any_label', 'create_label', 'update_label', 'delete_label',
            'page_TimeTracker',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Super Admin - all permissions
        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);
        $superAdmin->givePermissionTo(Permission::all());

        // Project Manager - can manage projects, tasks, milestones, labels and view time entries
        $projectManager = Role::firstOrCreate([
            'name' => 'project_manager',
            'guard_name' => 'web',
        ]);
        $projectManager->givePermissionTo([
            'view_project', 'view_any_project', 'create_project', 'update_project',
            'view_task', 'view_any_task', 'create_task', 'update_task', 'delete_task',
            'view_milestone', 'view_any_milestone', 'create_milestone', 'update_milestone', 'delete_milestone',
            'view_time::entry', 'view_any_time::entry', 'create_time::entry',
            'view_label', 'view_any_label', 'create_label', 'update_label',
            'page_TimeTracker',
        ]);

        // Employee - can only log time and update assigned tasks
        $employee = Role::firstOrCreate([
            'name' => 'employee',
            'guard_name' => 'web',
        ]);
        $employee->givePermissionTo([
            'view_project', 'view_any_project',
            'view_task', 'view_any_task', 'update_task',
            'view_milestone', 'view_any_milestone',
            'view_time::entry', 'view_any_time::entry', 'create_time::entry', 'update_time::entry',
            'view_label', 'view_any_label',
            'page_TimeTracker',
        ]);
    }
}
