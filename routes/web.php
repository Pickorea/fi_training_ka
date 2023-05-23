<?php

use Illuminate\Support\Facades\Route;

//KoolReportController
use App\Http\Controllers\KoolReportController\KoolReportController;
//ExcelReportController
use App\Http\Controllers\ExcelReportController\ExcelReportController;

//Training

use App\Http\Controllers\Training\IslandController;
use App\Http\Controllers\Training\TrainingController;
use App\Http\Controllers\Training\TrainingTypeController;
use App\Http\Controllers\Training\VillageController;
use App\Http\Controllers\Training\ChartController;

//Alert System
use App\Http\Controllers\AlertSystem\WorkStatusController;
use App\Http\Controllers\AlertSystem\EmployeeController;
use App\Http\Controllers\AlertSystem\EmployeeWorkStatusController;
use App\Http\Controllers\AlertSystem\SpaController;
use App\Http\Controllers\AlertSystem\NotifyController;
use App\Http\Controllers\AlertSystem\ArtisanCommandController;
use App\Http\Controllers\AlertSystem\DepartmentController;
use App\Http\Controllers\AlertSystem\SchoolController;
use App\Http\Controllers\AlertSystem\QualificationController;
use App\Http\Controllers\AlertSystem\EducationController;
use App\Http\Controllers\AlertSystem\JobTitleController;
use App\Http\Controllers\AlertSystem\VacancyController;
use App\Http\Controllers\AlertSystem\SalaryScaleController;
use App\Http\Controllers\AlertSystem\RecommendedSalaryScaleController;

//displinary 
use App\Http\Controllers\Displinary\DisplinaryActionController;

//Vessel Registration
use App\Http\Controllers\VesselRegistration\VesselRegistrationController;

use App\Http\Controllers\Weather\WeatherController;

//access management
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function ()
 {
    
/**Human Resource Role */
    //employee
    Route::group([
        'as' => 'employee.',
        'prefix' => 'employee',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index');
        Route::get('/job_titles/{employee_id}', [EmployeeController::class, 'getEmployeesJobTitles'])->name('getEmployeesJobTitles');
        Route::get('create', [EmployeeController::class, 'create'])->name('create');
        Route::post('', [EmployeeController::class, 'store'])->name('store');
       
        Route::post('employee/datatable', [EmployeeController::class, 'getDataTables'])->name('datatables');
        Route::group(['prefix' => '{kiisland?}'], function () { 
        Route::get('', [EmployeeController::class, 'show'])->name('show');
        Route::get('edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [EmployeeController::class, 'update'])->name('update');
        Route::delete('', [EmployeeController::class, 'delete'])->name('delete');
        });
    });

    //work_status
    Route::group([
        'as' => 'work_status.',
        'prefix' => 'work_status',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [WorkStatusController::class, 'index'])->name('index');
        Route::get('koolexcel', [WorkStatusController::class, 'export'])->name('koolexcel');
        Route::get('excel', [WorkStatusController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [WorkStatusController::class, 'create'])->name('create');
        Route::post('', [WorkStatusController::class, 'store'])->name('store');
        Route::get('datatable', [WorkStatusController::class, 'getForDataTable'])->name('datatable');
        Route::group(['prefix' => '{WorkStatus}'], function () { 
        Route::get('', [WorkStatusController::class, 'show'])->name('show');
        Route::get('edit', [WorkStatusController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [WorkStatusController::class, 'update'])->name('update');
        Route::delete('', [WorkStatusController::class, 'delete'])->name('delete');
        });
    });


       //employeeworkstatuses
       Route::group([
        'as' => 'employeeworkstatuses.',
        'prefix' => 'employeeworkstatuses',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [EmployeeWorkStatusController::class, 'index'])->name('index');
        Route::get('create', [EmployeeWorkStatusController::class, 'create'])->name('create');
        Route::post('', [EmployeeWorkStatusController::class, 'store'])->name('store');
        Route::get('{id}/edit', [EmployeeWorkStatusController::class, 'edit'])->name('edit');

        Route::get('export', [EmployeeWorkStatusController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{kiisland?}'], function () { 
        Route::get('', [EmployeeWorkStatusController::class, 'show'])->name('show');
        // Route::get('edit', [EmployeeWorkStatusController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [EmployeeWorkStatusController::class, 'update'])->name('update');
        Route::delete('', [EmployeeWorkStatusController::class, 'delete'])->name('delete');
        });
    });
   
       //spas
       Route::group([
        'as' => 'spas.',
        'prefix' => 'spas',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [SpaController::class, 'index'])->name('index');
        Route::get('create', [SpaController::class, 'create'])->name('create');
        Route::post('', [SpaController::class, 'store'])->name('store');
        Route::get('export', [SpaController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{kiisland?}'], function () { 
        Route::get('', [SpaController::class, 'show'])->name('show');
        Route::get('edit', [SpaController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [SpaController::class, 'update'])->name('update');
        Route::delete('', [SpaController::class, 'delete'])->name('delete');
        });
    });

     //notify
        Route::group([
        'as' => 'notify.',
        'prefix' => 'notify',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [NotifyController::class, 'index'])->name('index');
        Route::get('create', [NotifyController::class, 'create'])->name('create');
        Route::post('', [NotifyController::class, 'store'])->name('store');
        Route::get('export', [NotifyController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{notify}'], function () { 
        Route::get('', [NotifyController::class, 'show'])->name('show');
        Route::get('edit', [NotifyController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [NotifyController::class, 'update'])->name('update');
        Route::delete('', [NotifyController::class, 'delete'])->name('delete');
        });
    });

     //artisan
     Route::group([
        'as' => 'artisan.',
        'prefix' => 'artisan',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [ArtisanCommandController::class, 'RunArtisanCommand'])->name('command');
       
            });

      //department
      Route::group([
        'as' => 'department.',
        'prefix' => 'department',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [DepartmentController::class, 'index'])->name('index');
        Route::get('koolexcel', [DepartmentController::class, 'export'])->name('koolexcel');
        Route::get('excel', [DepartmentController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [DepartmentController::class, 'create'])->name('create');
        Route::post('', [DepartmentController::class, 'store'])->name('store');
        Route::get('export', [DepartmentController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{department}'], function () { 
        Route::get('', [DepartmentController::class, 'show'])->name('show');
        Route::get('edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [DepartmentController::class, 'update'])->name('update');
        Route::delete('', [DepartmentController::class, 'delete'])->name('delete');
        });
    });

     //school
     Route::group([
        'as' => 'school.',
        'prefix' => 'school',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [SchoolController::class, 'index'])->name('index');
        Route::get('koolexcel', [SchoolController::class, 'export'])->name('koolexcel');
        Route::get('excel', [SchoolController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [SchoolController::class, 'create'])->name('create');
        Route::post('', [SchoolController::class, 'store'])->name('store');
        Route::get('export', [SchoolController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{school}'], function () { 
        Route::get('', [SchoolController::class, 'show'])->name('show');
        Route::get('edit', [SchoolController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [SchoolController::class, 'update'])->name('update');
        Route::delete('', [SchoolController::class, 'delete'])->name('delete');
        });
    });

     //qualification
     Route::group([
        'as' => 'qualification.',
        'prefix' => 'qualification',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [QualificationController::class, 'index'])->name('index');
        Route::get('koolexcel', [QualificationController::class, 'export'])->name('koolexcel');
        Route::get('excel', [QualificationController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [QualificationController::class, 'create'])->name('create');
        Route::post('', [QualificationController::class, 'store'])->name('store');
        Route::get('export', [QualificationController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{qualification}'], function () { 
        Route::get('', [QualificationController::class, 'show'])->name('show');
        Route::get('edit', [QualificationController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [QualificationController::class, 'update'])->name('update');
        Route::delete('', [QualificationController::class, 'delete'])->name('delete');
        });
    });

    //education
    Route::group([
        'as' => 'education.',
        'prefix' => 'education',
        'middleware' => ['auth', 'role:hr'],
    ], function () {
        Route::get('', [EducationController::class, 'index'])->name('index');
        Route::get('koolexcel', [EducationController::class, 'export'])->name('koolexcel');
        Route::get('excel', [EducationController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [EducationController::class, 'create'])->name('create');
        Route::post('', [EducationController::class, 'store'])->name('store');
        Route::get('export', [EducationController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{education}'], function () { 
        Route::get('', [EducationController::class, 'show'])->name('show');
        Route::get('edit', [EducationController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [EducationController::class, 'update'])->name('update');
        Route::delete('', [EducationController::class, 'delete'])->name('delete');
        });
    });

    /**Trainer role */

     //island
     Route::group([
        'as' => 'island.',
        'prefix' => 'island',
        'middleware' => ['auth', 'role:trainer'],
    ], function () {
        Route::get('', [IslandController::class, 'index'])->name('index');
        Route::get('village/{id}', [IslandController::class, 'getVillage'])->name('village');
        Route::get('create', [IslandController::class, 'create'])->name('create');
        Route::post('', [IslandController::class, 'store'])->name('store');
        Route::get('export', [IslandController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{kiisland?}'], function () { 
        Route::get('', [IslandController::class, 'show'])->name('show');
        Route::get('edit', [IslandController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [IslandController::class, 'update'])->name('update');
        Route::delete('', [IslandController::class, 'delete'])->name('delete');
        });
    });

    //training detail
    Route::group([
        'as' => 'training.',
        'prefix' => 'training',
        'middleware' => ['auth', 'role:trainer'],
    ], function () {
        Route::get('', [TrainingController::class, 'index'])->name('index');
        Route::get('list', [TrainingController::class, 'islandList'])->name('islandList');
        Route::get('create/{island_id}', [TrainingController::class, 'create'])->name('create');
        Route::post('', [TrainingController::class, 'store'])->name('store');
        Route::get('export', [TrainingController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{training?}'], function () { 
       
        Route::get('', [TrainingController::class, 'show'])->name('show');
        Route::get('edit', [TrainingController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [TrainingController::class, 'update'])->name('update');
        Route::delete('', [TrainingController::class, 'delete'])->name('delete');
        });
    });

     //training_type
     Route::group([
        'as' => 'training_type.',
        'prefix' => 'training_type',
        'middleware' => ['auth', 'role:trainer'],
    ], function () {
        Route::get('', [TrainingTypeController::class, 'index'])->name('index');
        Route::get('create', [TrainingTypeController::class, 'create'])->name('create');
        Route::post('', [TrainingTypeController::class, 'store'])->name('store');
        Route::get('export', [TrainingTypeController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{type}'], function () { 
        
        Route::get('', [TrainingTypeController::class, 'show'])->name('show');
        Route::get('edit', [TrainingTypeController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [TrainingTypeController::class, 'update'])->name('update');
        Route::delete('', [TrainingTypeController::class, 'delete'])->name('delete');
        });
    });

     //village
     Route::group([
        'as' => 'village.',
        'prefix' => 'village',
        'middleware' => ['auth', 'role:trainer'],
    ], function () {
        Route::get('', [VillageController::class, 'index'])->name('index');
        Route::get('create', [VillageController::class, 'create'])->name('create');
        Route::post('', [VillageController::class, 'store'])->name('store');
        Route::get('export', [VillageController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{type}'], function () { 
        Route::get('', [VillageController::class, 'show'])->name('show');
        Route::get('edit', [VillageController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [VillageController::class, 'update'])->name('update');
        Route::delete('', [VillageController::class, 'delete'])->name('delete');
        });
    });

     //koolreports
     Route::group(['as' => 'koolreport.', 'prefix' => 'koolreport'], function () {
        Route::get('rep', [KoolReportController::class, 'koolworkstatus'])->name('_workstatusmindex');
        Route::get('repo', [KoolReportController::class, 'kooltraining'])->name('_kooltrainingindex');        
        Route::get('', [KoolReportController::class, '_repo'])->name('repo');
        Route::get('training', [KoolReportController::class, 'generatePDF'])->name('pdf');
       
       
    });


     //Excelreports
     Route::group(['as' => 'excelreport.', 'prefix' => 'excelreport'], function () {
              
        Route::get('', [ExcelReportController::class, '_repo'])->name('repo');
        Route::get('training', [ExcelReportController::class, 'generatePDF'])->name('pdf');
        Route::get('Excelexcel', [ExcelReportController::class, 'export'])->name('Excelexcel');
        Route::get('excel', [ExcelReportController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('employee', [ExcelReportController::class, 'exportemployeelist'])->name('employeeexcel');
        Route::get('active', [ExcelReportController::class, 'activeExpireEmployeelist'])->name('activeExpireEmployeelist');
        Route::post('', [ExcelReportController::class, 'store'])->name('store');
        Route::get('export', [ExcelReportController::class, 'exportlist'])->name('export');
       
    });

     //chart
     Route::group(['as' => 'chart.', 'prefix' => 'chart'], function () {
        Route::get('', [ChartController::class, 'index'])->name('index');
        Route::get('koolexcel', [ChartController::class, 'export'])->name('koolexcel');
        Route::get('excel', [ChartController::class, 'exportTrainingAttendance'])->name('excel');
        Route::get('create', [ChartController::class, 'create'])->name('create');
        Route::post('', [ChartController::class, 'store'])->name('store');
        Route::get('export', [ChartController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{chart}'], function () { 
        Route::get('', [ChartController::class, 'show'])->name('show');
        Route::get('edit', [ChartController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [ChartController::class, 'update'])->name('update');
        Route::delete('', [ChartController::class, 'delete'])->name('delete');
        });
    });

    

    //weather
    Route::group(['as' => 'weather.', 'prefix' => 'weather'], function () {
        Route::get('getCurrentByCity', [WeatherController::class, 'getCurrentByCity'])->name('getCurrentByCity');
        Route::get('get3HourlyByCity', [WeatherController::class, 'get3HourlyByCity'])->name('get3HourlyByCity');
        Route::get('ajaxget3HourlyByCity', [WeatherController::class, 'ajaxget3HourlyByCity'])->name('ajaxget3HourlyByCity');
        Route::get('create', [WeatherController::class, 'create'])->name('create');
        Route::post('', [WeatherController::class, 'store'])->name('store');
        Route::get('export', [WeatherController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{weather}'], function () { 
        Route::get('', [WeatherController::class, 'show'])->name('show');
        Route::get('edit', [WeatherController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [WeatherController::class, 'update'])->name('update');
        Route::delete('', [WeatherController::class, 'delete'])->name('delete');
        });
    });


    //vessel registation
    Route::group(['as' => 'vessel-registrations.', 'prefix' => 'vessel-registrations'], function () {
        Route::get('', [VesselRegistrationController::class, 'index'])->name('index');
        Route::get('/villages/{village}/island', [VesselRegistrationController::class, 'getIsland'])->name('getIsland');
        Route::get('create', [VesselRegistrationController::class, 'create'])->name('create');
        Route::post('', [VesselRegistrationController::class, 'store'])->name('store');
        Route::group(['prefix' => '{VesselRegister}'], function () { 
        Route::get('', [VesselRegistrationController::class, 'show'])->name('show');
         Route::get('edit', [VesselRegistrationController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [VesselRegistrationController::class, 'update'])->name('update');
        Route::delete('', [VesselRegistrationController::class, 'delete'])->name('delete');
        });
    });


    
    //vessel registation
    Route::group(['as' => 'vessel-registrations.', 'prefix' => 'vessel-registrations'], function () {
        Route::get('', [VesselRegistrationController::class, 'index'])->name('index');
        Route::get('/villages/{village}/island', [VesselRegistrationController::class, 'getIsland'])->name('getIsland');
        Route::get('create', [VesselRegistrationController::class, 'create'])->name('create');
        Route::post('', [VesselRegistrationController::class, 'store'])->name('store');
        Route::group(['prefix' => '{VesselRegister}'], function () { 
        Route::get('', [VesselRegistrationController::class, 'show'])->name('show');
         Route::get('edit', [VesselRegistrationController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [VesselRegistrationController::class, 'update'])->name('update');
        Route::delete('', [VesselRegistrationController::class, 'delete'])->name('delete');
        });
    });



});

Route::group([
    'as' => 'access-management.',
    'prefix' => 'access-management',
    'middleware' => ['auth', 'role:administrator']
], function () {
    // users
    Route::group(['as' => 'users.', 'prefix' => 'users', 'middleware' => ['auth', 'role:administrator']], function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('', [UserController::class, 'show'])->name('show');
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [UserController::class, 'update'])->name('update');
            Route::delete('', [UserController::class, 'destroy'])->name('destroy');
        });
    });

    // roles
    Route::group(['as' => 'roles.', 'prefix' => 'roles', 'middleware' => ['auth', 'role:administrator']], function () {
        Route::get('', [RolesController::class, 'index'])->name('index');
        Route::get('create', [RolesController::class, 'create'])->name('create');
        Route::post('', [RolesController::class, 'store'])->name('store');
        Route::group(['prefix' => '{role}'], function () {
            Route::get('', [RolesController::class, 'show'])->name('show');
            Route::get('edit', [RolesController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [RolesController::class, 'update'])->name('update');
            Route::delete('', [RolesController::class, 'destroy'])->name('destroy');
        });
    });

    // permissions
    Route::group(['as' => 'permissions.', 'prefix' => 'permissions', 'middleware' => ['auth', 'role:administrator']], function () {
        Route::get('', [PermissionsController::class, 'index'])->name('index');
        Route::get('create', [PermissionsController::class, 'create'])->name('create');
        Route::post('', [PermissionsController::class, 'store'])->name('store');
        Route::group(['prefix' => '{permission}'], function () {
            Route::get('', [PermissionsController::class, 'show'])->name('show');
            Route::get('edit', [PermissionsController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [PermissionsController::class, 'update'])->name('update');
            Route::delete('', [PermissionsController::class, 'destroy'])->name('destroy');
        });
    });
});


 //displinary
 Route::group([
    'as' => 'displinary-action.',
    'prefix' => 'displinary-action',
    'middleware' => ['auth', 'role:hr'],
], function () {
    Route::get('', [DisplinaryActionController::class, 'index'])->name('index');
    Route::get('/search', [DisplinaryActionController::class, 'search'])->name('displinary-action.search');
    Route::get('/report', [DisplinaryActionController::class, '_allReport'])->name('displinary-action._allreport');
    Route::get('/generate-letter/{actionType}/{employeeId}', [DisplinaryActionController::class, 'generateLetterPdf'])->name('displinary-action.generateLetter');
    Route::get('koolexcel', [DisplinaryActionController::class, 'export'])->name('koolexcel');
    Route::get('excel', [DisplinaryActionController::class, 'exportTrainingAttendance'])->name('excel');
    Route::get('create', [DisplinaryActionController::class, 'create'])->name('create');
    Route::post('', [DisplinaryActionController::class, 'store'])->name('store');
    Route::get('export', [DisplinaryActionController::class, 'exportlist'])->name('export');
    Route::group(['prefix' => '{displinaryaction}'], function () { 
    Route::get('', [DisplinaryActionController::class, 'show'])->name('show');
    Route::get('', [DisplinaryActionController::class, 'employeeReport'])->name('employeeReport');
    Route::get('edit', [DisplinaryActionController::class, 'edit'])->name('edit');
    Route::match(['PUT', 'PATCH'], '', [DisplinaryActionController::class, 'update'])->name('update');
    Route::delete('', [DisplinaryActionController::class, 'delete'])->name('delete');
    });
});


 //jobtitle
 Route::group([
    'as' => 'jobtitle.',
    'prefix' => 'jobtitle',
    'middleware' => ['auth', 'role:hr'],
], function () {
    Route::get('', [JobTitleController::class, 'index'])->name('index');
    Route::get('/datatables', [JobTitleController::class, 'getDataTables'])->name('datatables');
    Route::get('jobtitles/{department_id}', [JobTitleController::class, 'getJobTitlesByDepartment'])->name('getJobTitlesByDepartment');
    Route::get('excel', [JobTitleController::class, 'exportTrainingAttendance'])->name('excel');
    Route::get('create', [JobTitleController::class, 'create'])->name('create');
    Route::post('', [JobTitleController::class, 'store'])->name('store');
    Route::get('export', [JobTitleController::class, 'exportlist'])->name('export');
    Route::group(['prefix' => '{jobtitle}'], function () { 
    Route::get('', [JobTitleController::class, 'show'])->name('show');
    Route::get('edit', [JobTitleController::class, 'edit'])->name('edit');
    Route::match(['PUT', 'PATCH'], '', [JobTitleController::class, 'update'])->name('update');
    Route::delete('', [JobTitleController::class, 'delete'])->name('delete');
    });
});

 //Vacancy
 Route::group([
    'as' => 'vacancy.',
    'prefix' => 'vacancy',
    'middleware' => ['auth', 'role:hr'],
], function () {
    Route::get('', [VacancyController::class, 'index'])->name('index');
    Route::get('create', [VacancyController::class, 'create'])->name('create');

    Route::post('', [VacancyController::class, 'store'])->name('store');
    Route::get('vacancys/{job_title_id}', [VacancyController::class, 'getJobTitleByVacancy']);
    Route::group(['prefix' => '{vacancy}'], function () { 
        Route::get('', [VacancyController::class, 'show'])->name('show');
        Route::get('edit', [VacancyController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [VacancyController::class, 'update'])->name('update');
        Route::delete('', [VacancyController::class, 'delete'])->name('delete');
        Route::put('/update-status', [VacancyController::class, 'updateStatus'])->name('updateStatus');
    });
});


//Salary Scale
Route::group([
    'as' => 'salaryscales.',
    'prefix' => 'salaryscales',
    'middleware' => ['auth', 'role:hr'],
], function () {
    Route::get('', [SalaryScaleController::class, 'index'])->name('index');
    Route::get('create', [SalaryScaleController::class, 'create'])->name('create');
    Route::post('', [SalaryScaleController::class, 'store'])->name('store');
    Route::get('salaryscales/{job_title_id}', [SalaryScaleController::class, 'getSalaryscalesByJobtitle'])->name('getSalaryscalesByJobtitle');
      Route::group(['prefix' => '{salaryscale}'], function () { 
        Route::get('', [SalaryScaleController::class, 'show'])->name('show');
        Route::get('edit', [SalaryScaleController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [SalaryScaleController::class, 'update'])->name('update');
        Route::delete('', [SalaryScaleController::class, 'delete'])->name('delete');
        
    });
});


//Recommended Salary Scale
Route::group([
    'as' => 'recommendedsalaryscales.',
    'prefix' => 'recommendedsalaryscales',
    'middleware' => ['auth', 'role:hr'],
], function () {
    Route::get('', [RecommendedSalaryScaleController::class, 'index'])->name('index');
    Route::get('create', [RecommendedSalaryScaleController::class, 'create'])->name('create');
    Route::get('/{job_title_id}', [RecommendedSalaryScaleController::class, 'getRecommendedSalaryScalesByJobTitle'])->name('getRecommendedSalaryScalesByJobTitle');
    
    Route::post('', [RecommendedSalaryScaleController::class, 'store'])->name('store');
      Route::group(['prefix' => '{recommendedsalaryscale}'], function () { 
        Route::get('', [RecommendedSalaryScaleController::class, 'show'])->name('show');
        Route::get('edit', [RecommendedSalaryScaleController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [RecommendedSalaryScaleController::class, 'update'])->name('update');
        Route::delete('', [RecommendedSalaryScaleController::class, 'delete'])->name('delete');
        
    });
});
