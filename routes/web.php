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
    

    //employee
    Route::group(['as' => 'employee.', 'prefix' => 'employee'], function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index');
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

     //island
     Route::group(['as' => 'island.', 'prefix' => 'island'], function () {
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
    Route::group(['as' => 'training.', 'prefix' => 'training'], function () {
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
     Route::group(['as' => 'training_type.', 'prefix' => 'training_type'], function () {
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
     Route::group(['as' => 'village.', 'prefix' => 'village'], function () {
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

    //workstatus
    Route::group(['as' => 'work_status.', 'prefix' => 'work_status'], function () {
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


       //employeework Status
       Route::group(['as' => 'employeeworkstatuses.', 'prefix' => 'employeeworkstatuses'], function () {
        Route::get('', [EmployeeWorkStatusController::class, 'index'])->name('index');
        Route::get('create', [EmployeeWorkStatusController::class, 'create'])->name('create');
        Route::post('', [EmployeeWorkStatusController::class, 'store'])->name('store');
        Route::get('export', [EmployeeWorkStatusController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{kiisland?}'], function () { 
        Route::get('', [EmployeeWorkStatusController::class, 'show'])->name('show');
        Route::get('edit', [EmployeeWorkStatusController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'PATCH'], '', [EmployeeWorkStatusController::class, 'update'])->name('update');
        Route::delete('', [EmployeeWorkStatusController::class, 'delete'])->name('delete');
        });
    });
   
       //employeework Status
       Route::group(['as' => 'spas.', 'prefix' => 'spas'], function () {
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

     //employeework Status
     Route::group(['as' => 'notify.', 'prefix' => 'notify'], function () {
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

     //employeework Status
     Route::group(['as' => 'artisan.', 'prefix' => 'artisan'], function () {
        Route::get('', [ArtisanCommandController::class, 'RunArtisanCommand'])->name('command');
       
            });

      //Department
      Route::group(['as' => 'department.', 'prefix' => 'department'], function () {
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


});