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
            ,
            [
                'name' => 'School',
                'route' => 'school.index',
                'ordering' => 14,
            ]

            ,
            [
                'name' => 'Qualification',
                'route' => 'qualification.index',
                'ordering' => 15,
            ]
            ,
            [
                'name' => 'Education',
                'route' => 'education.index',
                'ordering' => 15,
            ]
             ,
            [
                'name' => 'Current Weather',
                'route' => 'weather.getCurrentByCity',
                'ordering' => 15,
            ]
            ,
            [
                'name' => '3 Hour Weather Forcast',
                'route' => 'weather.get3HourlyByCity',
                'ordering' => 16,
            ]

            ,
            [
                'name' => 'Ajax Weather',
                'route' => 'weather.ajaxget3HourlyByCity',
                'ordering' => 16,
            ]

            ,
            [
                'name' => ' Vessel-registrations',
                'route' => 'vessel-registrations.index',
                'ordering' => 17,
            ]
            ,
            [
                'name' => ' Users Management',
                'route' => 'access-management.users.index',
                'ordering' => 18,
            ]
            ,
            [
                'name' => ' Roles Management',
                'route' => 'access-management.roles.index',
                'ordering' => 19,
            ]
            ,
            [
                'name' => ' Permission Management',
                'route' => 'access-management.permissions.index',
                'ordering' => 20,
            ]
            ,
            [
                'name' => ' Displinary Action',
                'route' => 'displinary-action.index',
                'ordering' => 21,
            ],
            [
                'name' => ' Vacancy',
                'route' => 'vacancy.index',
                'ordering' => 22,
            ],
            [
                'name' => ' Job Title',
                'route' => 'jobtitle.index',
                'ordering' => 23,
            ],

            [
                'name' => ' Salary Scale',
                'route' => 'salaryscales.index',
                'ordering' => 24,
            ],

            [
                'name' => ' Recommended Salary Scale',
                'route' => 'recommendedsalaryscales.index',
                'ordering' => 25,
            ]
            
            
            
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}