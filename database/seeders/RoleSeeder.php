<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Role::create(['name' => 'admin']);
        $teacher=Role::create(['name' => 'teacher']);
        $collab=Role::create(['name' => 'collab']);

        
        $editMember=Permission::create(['name' => 'edit-member']);
        $editCourse=Permission::create(['name' => 'edit-course']);
        $editProject=Permission::create(['name' => 'edit-project']);
        $editPublication=Permission::create(['name' => 'edit-publication']);

        
        $admin->givePermissionTo([
            $editMember
        ]);

        $teacher->givePermissionTo([
            $editMember,
            $editProject,
            $editCourse,
            $editPublication,
        ]);

        $collab->givePermissionTo([
             $editMember,
             $editProject,
             $editPublication,
        ]);


    }
}
