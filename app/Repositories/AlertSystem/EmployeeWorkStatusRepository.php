<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\EmployeeWorkStatus;
use App\Models\AlertSystem\RecommendedSalaryScale;

use Auth;
use Illuminate\Support\Facades\DB;
class EmployeeWorkStatusRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return EmployeeWorkStatus::class;
    }

	public function create(array $input)
	{
		//$user = Auth::user();
	
		//if (! $user->can('recreational.create'))
		//{
		//    throw new GeneralException(__('exceptions-app.frontend.not_auth'));
		//}
		
		$data = [];
		$data['employee_id'] = $input['employee_id'];
		$data['start_date'] = $input['start_date'];
		$data['end_date'] = $input['end_date'];
		$data['vacancy_id'] = $input['vacancy_id'];
		$data['recommended_salary_scale_id'] = $input['recommended_salary_scale_id'];
		$data['unestablished'] = $input['unestablished'];
		$item = $this->model();
		$item = new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
		$item->save();
		return $item;
	}
	
	public function update(Employee $model, array $input)
	{

	//$user = Auth::user();
	//if (! $user->can('recreational.edit'))
	//{
	//throw new GeneralException(__('exceptions-app.frontend.not_auth'));
	//}
	//	if ($user->organisation_id !== $model->owner_organisation_id)
	//	{
		//	throw  new GeneralException('No privallaged');

	
		//}
		$data = [];
		$data['employee_id'] = $input['employee_id'];
		$data['start_date'] = $input['start_date'];
		$data['end_date'] = $input['end_date'];
		$data['vacancy_id'] = $input['vacancy_id'];
		$data['recommended_salary_scale_id'] = $input['recommended_salary_scale_id'];
		$data['unestablished'] = $input['unestablished'];
		return $model->update($data);
	}

	
	public function getForDataTable($search = '', $order_by = '', $sort = 'asc')
{
    // $query = EmployeeWorkStatus::query()
    // ->join('recommended_salary_scales', 'recommended_salary_scales.id', '=', 'employee_work_statuses.recommended_salary_scale_id')
    // ->leftJoin('employees', 'employees.id', '=', 'employee_work_statuses.employee_id')
    // ->leftJoin('job_titles', 'job_titles.id', '=', 'employees.job_title_id')
    // ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
    // ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    // ->select(
    //     'employee_work_statuses.id AS employee_work_status_id', // Add this line to retrieve the employee_work_status_id
    //     'recommended_salary_scales.name AS recommended_salary_scale',
    //     'work_status.work_status_name',
    //     'employee_work_statuses.start_date',
    //     'employee_work_statuses.end_date',
    //     'employees.name AS employee_name',
    //     'job_titles.name AS job_title',
    //     'departments.department_name AS department',
    //     DB::raw('DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) AS day_count'),
    //     DB::raw('TIMESTAMPDIFF(DAY, NOW(), employee_work_statuses.end_date) AS countdown'),
    //     DB::raw('CASE WHEN employee_work_statuses.end_date < NOW() THEN "Expired" ELSE "Active" END AS status')
    // );

    // $query = EmployeeWorkStatus::query()
    // ->join('recommended_salary_scales', 'recommended_salary_scales.id', '=', 'employee_work_statuses.recommended_salary_scale_id')
    // ->leftJoin('employees', 'employees.id', '=', 'employee_work_statuses.employee_id')
    // ->leftJoin('job_titles', 'job_titles.id', '=', 'employees.job_title_id')
    // ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
    // ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    // ->select(
    //     'employee_work_statuses.id AS employee_work_status_id',
    //     'recommended_salary_scales.name AS recommended_salary_scale',
    //     'work_status.work_status_name',
    //     'employee_work_statuses.start_date',
    //     'employee_work_statuses.end_date',
    //     'employees.name AS employee_name',
    //     'job_titles.name AS job_title',
    //     'departments.department_name AS department',
    //     DB::raw('DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) AS day_count'),
    //     DB::raw('CASE
    //         WHEN employee_work_statuses.end_date < NOW() THEN "Expired"
    //         WHEN TIMESTAMPDIFF(DAY, NOW(), employee_work_statuses.end_date) <= 30 THEN TIMESTAMPDIFF(DAY, NOW(), employee_work_statuses.end_date)
    //         ELSE 1
    //         END AS countdown'),
    //     DB::raw('CASE WHEN employee_work_statuses.end_date < NOW() THEN "Expired" ELSE "Active" END AS status')
    // );

    $query = EmployeeWorkStatus::query()
    ->join('recommended_salary_scales', 'recommended_salary_scales.id', '=', 'employee_work_statuses.recommended_salary_scale_id')
    ->leftJoin('employees', 'employees.id', '=', 'employee_work_statuses.employee_id')
    ->leftJoin('job_titles', 'job_titles.id', '=', 'employees.job_title_id')
    ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
    ->leftJoin('work_status', 'work_status.id', '=', 'employees.work_status_id')
    ->select(
        'employee_work_statuses.id AS employee_work_status_id',
        'recommended_salary_scales.name AS recommended_salary_scale',
        'work_status.work_status_name',
        'employee_work_statuses.start_date',
        'employee_work_statuses.end_date',
        'employees.name AS employee_name',
        'job_titles.name AS job_title',
        'departments.department_name AS department',
        DB::raw('DATEDIFF(employee_work_statuses.end_date, employee_work_statuses.start_date) AS day_count'),
        DB::raw('CASE
            WHEN employee_work_statuses.end_date < NOW() THEN "Expired"
            WHEN TIMESTAMPDIFF(DAY, NOW(), employee_work_statuses.end_date) <= 0 THEN 0
            ELSE TIMESTAMPDIFF(DAY, NOW(), employee_work_statuses.end_date)
            END AS countdown'),
        DB::raw('CASE WHEN employee_work_statuses.end_date < NOW() THEN "Expired" ELSE "Active" END AS status')
    );



// Rest of the code...


    // Rest of the code...

    // Apply search filters if provided
    if ($search) {
        $query->where(function ($subquery) use ($search) {
            $subquery->where('recommended_salary_scales.name', 'LIKE', "%{$search}%")
                ->orWhere('work_status.work_status_name', 'LIKE', "%{$search}%")
                ->orWhere('employee_work_statuses.start_date', 'LIKE', "%{$search}%")
                ->orWhere('employee_work_statuses.end_date', 'LIKE', "%{$search}%")
                ->orWhere('employees.name', 'LIKE', "%{$search}%")
                ->orWhere('job_titles.name', 'LIKE', "%{$search}%");
        });
    }

    // Apply order by and sort direction if provided
    if ($order_by) {
        $query->orderBy('employee_work_statuses.' . $order_by, $sort)
            ->orderBy('recommended_salary_scales.id', $sort)
            ->orderBy('employee_work_statuses.id', $sort);
    }

    // Limit the number of results to 25
    $query->limit(25);

    // Execute the query and return the results
    $data['employees'] = $query->get();
    // dd($data['employees']);
    $data['jobTitleId'] = [];

    return $data;
}

	


	
	


public function getDaysCount($startDate, $endDate)
{
    $start = new \DateTime($startDate);
    $end = new \DateTime($endDate);
    $interval = $start->diff($end);

    return $interval->days;
}

public function isActive($endDate)
{
    $end = new \DateTime($endDate);
    $today = new \DateTime();

    return $end >= $today;
}


	   
public function pluck($column = 'name', $key = 'id')
{
    $salaryScales = $this->model->with('jobTitle')->orderBy($column)->get();

    $pluckData = [];

    foreach ($salaryScales as $salaryScale) {
        if (isset($salaryScale->jobTitle)) {
            $jobTitleName = $salaryScale->jobTitle->name;
            $salaryScaleName = $salaryScale->name;
            $pluckData[$salaryScale->$key] = "{$jobTitleName} - {$salaryScaleName}";
        }
    }

    return collect($pluckData);
}


	
}

?>