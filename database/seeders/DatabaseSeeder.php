<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NavbarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(TrainingTypeSeeder::class);
        $this->call(VillageSeeder::class);
        $this->call(UrlSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(WorkStatusSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(QualificationSeeder::class);
        $this->call(DepartmentSeeder::class);
        // $this->call(EmployeesTableSeeder::class);
        $this->call(JobTitleSeeder::class);
        $this->call(SalaryScaleSeeder::class);
        $this->call(LeaveEntitlementSeeder::class);
        // $this->call(RecommendedSalaryScalesTableSeeder::class);
        // $this->call(DisplinaryActionSeeder::class);
    }
}
