<?php
  
  namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\Training\Navbar;
  
class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'Home',
                'route' => 'home',
                'ordering' => 1,
            ],
            [
                'name' => 'Island',
                'route' => 'island.index',
                'ordering' => 2,
            ],
            [
                'name' => 'Village',
                'route' => 'village.index',
                'ordering' => 3,
            ],
            [
                'name' => 'Training Detail',
                'route' => 'training.index',
                'ordering' => 4,
            ],
            [
                'name' => 'Training Type',
                'route' => 'training_type.index',
                'ordering' => 5,
            ],

            [
                'name' => 'Report',
                'route' => 'koolreport.repo',
                'ordering' => 6,
            ],
            [
                'name' => 'Chart',
                'route' => 'chart.index',
                'ordering' => 7,
            ]
            ,
            [
                'name' => 'Employees',
                'route' => 'employee.index',
                'ordering' => 8,
            ]
            ,
            [
                'name' => 'Work Status',
                'route' => 'work_status.index',
                'ordering' => 9,
            ]

            ,
            [
                'name' => 'Employee Work Status',
                'route' => 'employeeworkstatuses.index',
                'ordering' => 9,
            ]

            ,
            [
                'name' => 'Performance Assessment',
                'route' => 'spas.index',
                'ordering' => 10,
            ]
            ,
            [
                'name' => 'Notify',
                'route' => 'notify.index',
                'ordering' => 11,
            ]
            ,
            [
                'name' => 'Send Notification',
                'route' => 'artisan.command',
                'ordering' => 12,
            ]
            ,
            [
                'name' => 'Department',
                'route' => 'department.index',
                'ordering' => 13,
            ]
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}