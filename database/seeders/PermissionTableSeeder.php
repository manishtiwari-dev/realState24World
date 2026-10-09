<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Module 1: Permission management
            ['name' => 'permission-list', 'module_id' => 1],
            ['name' => 'permission-create', 'module_id' => 1],
            ['name' => 'permission-edit', 'module_id' => 1],
            ['name' => 'permission-delete', 'module_id' => 1],
            // Module 2: Role management
            ['name' => 'role-list', 'module_id' => 2],
            ['name' => 'role-create', 'module_id' => 2],
            ['name' => 'role-edit', 'module_id' => 2],
            ['name' => 'role-delete', 'module_id' => 2],
            // Module 3: User management
            ['name' => 'user-list', 'module_id' => 3],
            ['name' => 'user-create', 'module_id' => 3],
            ['name' => 'user-edit', 'module_id' => 3],
            ['name' => 'user-delete', 'module_id' => 3],
            ['name' => 'user-status', 'module_id' => 3],
            // Module 4: Property management
            ['name' => 'property-list', 'module_id' => 4],
            ['name' => 'property-create', 'module_id' => 4],
            ['name' => 'property-edit', 'module_id' => 4],
            ['name' => 'property-delete', 'module_id' => 4],
            ['name' => 'property-status', 'module_id' => 4],
            // Module 5: Lead management
            ['name' => 'setting-dashboard', 'module_id' => 5],
            ['name' => 'setting-profile', 'module_id' => 5],
            ['name' => 'setting-settings', 'module_id' => 5],
            ['name' => 'setting-social-media', 'module_id' => 5],
            ['name' => 'setting-change-password', 'module_id' => 5],
            ['name' => 'setting-activity-logs', 'module_id' => 5],
            // Module 6: Banner management
            ['name' => 'banner-list', 'module_id' => 6],
            ['name' => 'banner-create', 'module_id' => 6],
            ['name' => 'banner-edit', 'module_id' => 6],
            ['name' => 'banner-delete', 'module_id' => 6],
            ['name' => 'banner-status', 'module_id' => 6],
            // Module 7: Category management
            ['name' => 'category-list', 'module_id' => 7],
            ['name' => 'category-create', 'module_id' => 7],
            ['name' => 'category-edit', 'module_id' => 7],
            ['name' => 'category-delete', 'module_id' => 7],
            ['name' => 'category-status', 'module_id' => 7],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
