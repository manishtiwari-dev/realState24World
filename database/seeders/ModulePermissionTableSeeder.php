<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModulePermission;

class ModulePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'Permission',
            'Role',
            'User',
            'Property',
            'Setting',
            'Banner',
            'Category',
         ];
         
         foreach ($modules as $module) {
            ModulePermission::create(['module' => $module]);
         }
    }
}
