<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User; // For assigning super-admin
use Illuminate\Support\Facades\Hash; // For Hash::make

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            // User Management
            'manage_users', 'view_users', 'create_users', 'edit_users', 'delete_users',
            // Role Management
            'manage_roles',
            // Student Management
            'manage_students', 'view_students', 'create_students', 'edit_students', 'delete_students', 'enroll_students',
            // Academic Management
            'manage_academic_years', 'manage_departments', 'manage_faculties', 'manage_courses', 'manage_classes',
            // Exam Management
            'manage_exams', 'enter_grades', 'view_results', 'publish_results',
            // Finance Management
            'manage_fees', 'manage_invoices', 'process_payments', 'view_financial_reports',
            // Settings Management
            'manage_settings',
            // Audit Log
            'view_audit_logs',
            // General Teacher Permissions
            'view_assigned_classes', 'manage_own_grades',
            // General Student Permissions
            'view_own_profile', 'view_own_results', 'view_own_fees',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $this->command->info('Permissions created successfully.');

        // Define Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $teacherRole = Role::firstOrCreate(['name' => 'Teacher', 'guard_name' => 'web']);
        $accountantRole = Role::firstOrCreate(['name' => 'Accountant', 'guard_name' => 'web']);
        $examinerRole = Role::firstOrCreate(['name' => 'Examiner', 'guard_name' => 'web']);
        $studentRole = Role::firstOrCreate(['name' => 'Student', 'guard_name' => 'web']);
        $this->command->info('Roles created successfully.');

        // Assign Permissions to Roles
        $superAdminRole->givePermissionTo(Permission::all());
        $this->command->info('Super-admin permissions assigned.');

        $adminRole->givePermissionTo([
            'manage_users', 'view_users', 'create_users', 'edit_users', 'delete_users',
            'manage_roles',
            'manage_students', 'view_students', 'create_students', 'edit_students', 'delete_students', 'enroll_students',
            'manage_academic_years', 'manage_departments', 'manage_faculties', 'manage_courses', 'manage_classes',
            'manage_exams', 'view_results', 'publish_results',
            'manage_settings',
            'view_audit_logs',
        ]);
        $this->command->info('Admin permissions assigned.');

        $teacherRole->givePermissionTo([
            'view_assigned_classes', 'manage_own_grades', 'view_students',
            'view_own_profile',
        ]);
        $this->command->info('Teacher permissions assigned.');

        $accountantRole->givePermissionTo([
            'manage_fees', 'manage_invoices', 'process_payments', 'view_financial_reports',
            'view_students',
            'view_own_profile',
        ]);
        $this->command->info('Accountant permissions assigned.');

        $examinerRole->givePermissionTo([
            'manage_exams', 'enter_grades', 'view_results',
            'view_own_profile',
        ]);
        $this->command->info('Examiner permissions assigned.');

        $studentRole->givePermissionTo([
            'view_own_profile', 'view_own_results', 'view_own_fees',
        ]);
        $this->command->info('Student permissions assigned.');

        // Create a Super Admin User
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Corrected to Hash::make
                'gender' => 'other',
                'contact' => '1234567890'
            ]
        );
        $superAdminUser->assignRole($superAdminRole);
        $this->command->info('Super Admin user created and role assigned.');
    }
}
