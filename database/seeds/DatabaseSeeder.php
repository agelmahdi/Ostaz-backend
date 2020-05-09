<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Permissioncategory;
use App\Role;
use App\Admin;
use App\Customer;
use App\Post;
use App\Option;
use App\Localization;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ask for confirmation to refresh migration
            $this->command->call('key:generate');
            $this->command->call('jwt:secret');
            $this->command->call('migrate:refresh');
            $this->command->call('config:clear');
            $this->command->call('cache:clear');
            $this->command->call('view:clear');
            $this->command->call('route:clear');
            $this->command->warn("Data deleted, starting from fresh database.");
        // Seed the default localization
        $options = [
            ['key' => 'website_name_ar', 'value' => 'تجريبي'],
            ['key' => 'website_name_en', 'value' => 'Demo'],
            ['key' => 'logo_image'],
            ['key' => 'facebook',],
            ['key' => 'twitter'],
            ['key' => 'google'],
        ];
        foreach ($options as $option) {
            Option::create($option);
        }
        // Seed the default localization
        $localizations = [
            ['key' => 'homepage', 'value_en' => 'Home', 'value_ar' => 'الرئيسية',],
            ['key' => 'aboutus', 'value_en' => 'About Us', 'value_ar' => 'عن البرنامج',],
            ['key' => 'test', 'value_en' => 'Testing', 'value_ar' => 'اختبار',],
            ['key' => 'middlename', 'value_en' => 'Middle Name', 'value_ar' => 'الاسم الاوسط',],
            ['key' => 'firstname', 'value_en' => 'First Name', 'value_ar' => 'الاسم الاول',],
            ['key' => 'contactus', 'value_en' => 'Contact Us', 'value_ar' => 'تواصل معنا',],
            ['key' => 'lastname', 'value_en' => 'Last Name', 'value_ar' => 'اسم العائلة',],

        ];
        // Seed the default localization
        $adminlocalizations = [
            ['key' => 'homepage', 'value_en' => 'Home', 'value_ar' => 'الرئيسية',],
            ['key' => 'PERSONAL', 'value_en' => 'Primary', 'value_ar' => 'اساسي',],
            ['key' => 'dashboard', 'value_en' => 'Dashboard', 'value_ar' => 'الصفحة الرئيسية',],
            ['key' => 'usermanegment', 'value_en' => 'User Manegment', 'value_ar' => 'إدارة المستخدم',],
            ['key' => 'permissioncategory', 'value_en' => 'Permission Category', 'value_ar' => 'مجموعة الاذونات',],
            ['key' => 'permission', 'value_en' => 'Permission', 'value_ar' => 'الاذونات',],
            ['key' => 'role', 'value_en' => 'Role', 'value_ar' => 'الوظيفة',],
            ['key' => 'user', 'value_en' => 'User', 'value_ar' => 'المستخدم',],
            ['key' => 'datamanagement', 'value_en' => 'Data Management', 'value_ar' => 'ادارة البيانات',],
            ['key' => 'category', 'value_en' => 'Category', 'value_ar' => 'مجموعة اساسية',],
            ['key' => 'quiz', 'value_en' => 'Quiz', 'value_ar' => 'الاختبار',],
            ['key' => 'academicyears', 'value_en' => 'Academic Year', 'value_ar' => 'السنة الدراسية',],
            ['key' => 'subject', 'value_en' => 'Subject', 'value_ar' => 'المواد الدراسية',],
            ['key' => 'subcategory', 'value_en' => 'Sub Category', 'value_ar' => 'مجموعة فرعية',],
            ['key' => 'sitedata', 'value_en' => 'Site Data', 'value_ar' => 'ادارة الموقع',],
            ['key' => 'settings', 'value_en' => 'Settings', 'value_ar' => 'الاعدادات',],
            ['key' => 'option', 'value_en' => 'Options', 'value_ar' => 'اعدادات متغيرة',],
            ['key' => 'localization', 'value_en' => 'Localization', 'value_ar' => 'ادارة اللغة للموقع',],
            ['key' => 'adminlocalization', 'value_en' => 'Admin loc', 'value_ar' => 'ادارة اللغة للادمن',],
            ['key' => 'logout', 'value_en' => 'Logout', 'value_ar' => 'الخروج',],


        ];

        foreach ($localizations as $localization) {
            Localization::create($localization);
        }
        foreach ($adminlocalizations as $adminlocalization) {
            \App\adminLocalization::create($adminlocalization);
        }
        // Seed the default permissions
        $permissions = $this->defaultPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        // Seed the default Permissioncategory
        $cat_permissions = $this->defaultPermissioncategory();

        foreach ($cat_permissions as $cat_permission) {
            Permissioncategory::firstOrCreate(['name' => $cat_permission]);
        }
        $this->command->info('Default Permissions added.');
            // Ask to confirm to assign admin or user role
            // Ask for roles from input
            $roles = 'Admin';
            // Explode roles
            $rolesArray = explode(',', $roles);
            // add roles
            foreach ($rolesArray as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);
                if ($role->name == 'Admin') {
                    // assign all permissions to admin role
                    $role->permissions()->sync(Permission::all());
                    $this->command->info('Admin will have full rights');
                } else {
                    // for others, give access to view only
                    $role->permissions()->sync(Permission::where('name', 'LIKE', 'view_%')->get());
                }
                    // create one user for each role
                $this->createUser($role);
            }
        $this->call(AcademicyearSeed::class);
        $this->call(SubjectSeed::class);
        $this->call(CitiesSeed::class);
        $this->command->info('Roles ' . $roles . ' added successfully');
    }
    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(Admin::class)->create();
        $user->assignRole($role->name);
        if ($role->name == 'Admin') {
            $this->command->info('Admin login details:');
            $this->command->warn('Username : ' . $user->email);
            $this->command->warn('Password : "123123123"');
        }
    }
    private function defaultPermissions()
    {
        return ['role-list', 'role-create', 'role-edit', 'role-delete',
            'permission-list', 'permission-create', 'permission-edit', 'permission-delete',
            'main-userManagement', 'main-dataManagement', 'main-site',
            'permissioncategory-list', 'permissioncategory-create', 'permissioncategory-edit', 'permissioncategory-delete',
            'product-list', 'product-create', 'product-update', 'product-delete',
            'category-list', 'category-create', 'category-edit', 'category-delete',
            'category-showdetails', 'subcategory-list', 'subcategory-create', 'subcategory-edit', 'subcategory-delete',
            'subcategory-showdetails', 'user-list', 'user-create', 'user-edit', 'user-delete',
            'option-list', 'option-create', 'option-edit', 'option-delete',
            'localization-list', 'localization-create', 'localization-edit', 'localization-delete',
            'adminlocalization-list', 'adminlocalization-create', 'adminlocalization-edit', 'adminlocalization-delete',
            'quiz-showdetails', 'quiz-list', 'quiz-create', 'quiz-edit', 'quiz-delete',
            'questions-list', 'questions-create', 'questions-edit', 'questions-delete',
            'answer-list', 'answer-create', 'answer-edit', 'answer-delete',
            'result-list', 'result-create', 'result-edit', 'result-delete',
            'academic_year-list', 'academic_year-create', 'academic_year-edit', 'academic_year-delete',
            'subject-list', 'subject-create', 'subject-edit', 'subject-delete',
            'group-list', 'group-create', 'group-edit', 'group-delete'];
    }
    private function defaultPermissioncategory()
    {
        return ['main', 'permissioncategory', 'permission', 'role', 'user', 'category', 'subcategory', 'option', 'localization', 'adminlocalization', 'quiz', 'questions', 'answer', 'result','academic_year','subject','group'];
    }

}
