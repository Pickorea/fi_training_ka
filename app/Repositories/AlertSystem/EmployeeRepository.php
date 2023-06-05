<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\Employee;
use Auth;

class EmployeeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Employee::class;
    }

	public function create(array $input)
	{
		//$user = Auth::user();
	
		//if (! $user->can('recreational.create'))
		//{
		//    throw new GeneralException(__('exceptions-app.frontend.not_auth'));
		//}
		
		$data = [];
		$data['name'] = $input['name'];
		$data['email'] = $input['email'];
		$data['work_status_id'] = $input['work_status_id'];
		$data['department_id'] = $input['department_id'];
		$data['job_title_id'] = $input['job_title_id'];
		$data['salary_scale_id'] = $input['salary_scale_id'];
		$data['minimum_salary'] = isset($input['minimum_salary']) ? $input['minimum_salary'] : null;
		$data['maximum_salary'] = isset($input['maximum_salary']) ? $input['maximum_salary'] : null;
		$data['present_address'] = $input['present_address'];
		$data['pf_number'] = $input['pf_number'];
		$data['joining_date'] = $input['joining_date'];
		$data['gender'] = $input['gender'];
		$data['date_of_birth'] = $input['date_of_birth'];
		$data['marital_status'] = $input['marital_status'];
		$data['picture'] = $input['picture'];
	
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
		$data['name'] = $input['name'];
		$data['email'] = $input['email'];
		$data['work_status_id'] = $input['work_status_id'];
		$data['department_id'] = $input['department_id'];
		$data['job_title_id'] = $input['job_title_id'];
		$data['salary_scale_id'] = $input['salary_scale_id'];
		$data['minimum_salary'] = isset($input['minimum_salary']) ? $input['minimum_salary'] : null;
		$data['maximum_salary'] = isset($input['maximum_salary']) ? $input['maximum_salary'] : null;
		$data['present_address'] = $input['present_address'];
		$data['pf_number'] = $input['pf_number'];
		$data['joining_date'] = $input['joining_date'];
		$data['gender'] = $input['gender'];
		$data['date_of_birth'] = $input['date_of_birth'];
		$data['marital_status'] = $input['marital_status'];
		$data['picture'] = $input['picture'];
		return $model->update($data);
	}

	//$employees = DB::table('employees')
    //     ->select(
    //         'employees.id',
    //         'employees.created_at',
    //         'employees.name',
    //         'employees.email',
    //         'employees.pf_number',
    //         'employees.joining_date',
    //         'employees.gender',
    //         'employees.date_of_birth',
    //         'employees.marital_status',
    //         'work_status.work_status_name',
    //         'job_titles.name as job_title_name' // updated alias
    //     )
    //     ->leftJoin('work_status', 'employees.work_status_id', '=', 'work_status.id')
    //     ->leftJoin('job_titles', 'employees.job_title_id', '=', 'job_titles.id')
    //     ->get()
    //     ->toArray();
	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
{
    $dataTableQuery = $this->model->query()
        ->leftJoin('work_status', 'employees.work_status_id', '=', 'work_status.id')
        ->leftJoin('job_titles', 'employees.job_title_id', '=', 'job_titles.id')
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id') // Fix the join condition here
        ->select(
            'employees.id',
            'employees.created_at',
            'employees.name',
            'employees.email',
            'employees.pf_number',
            'employees.joining_date',
            'employees.gender',
            'employees.date_of_birth',
            'employees.marital_status',
			'employees.picture',
            'work_status.work_status_name',
            'job_titles.name as job_title_name',
            'departments.department_name' // Include department_name in the select statement
        );

    // Apply search criteria if provided
    if (!empty($search)) {
        $dataTableQuery->where(function ($query) use ($search) {
            $query->where('employees.name', 'like', '%' . $search . '%')
                  ->orWhere('employees.email', 'like', '%' . $search . '%')
                  ->orWhere('work_statuses.name', 'like', '%' . $search . '%')
                  ->orWhere('departments.department_name', 'like', '%' . $search . '%')
                  ->orWhere('job_titles.name', 'like', '%' . $search . '%');
        });
    }

    // Apply order and sorting criteria if provided
    if (!empty($order_by)) {
        $dataTableQuery->orderBy($order_by, $sort);
    }

    return $dataTableQuery->get();
}

	   
	public function pluck($column = 'name', $key = 'id')
{
    $salaryScales = $this->model->with('jobTitle')
        ->orderBy($column)
        ->get();

    $pluckData = collect([]);

    foreach ($salaryScales as $salaryScale) {
               $salaryScaleName = $salaryScale->name;
			   $jobTitleName = $salaryScale->jobTitle->name;
        $pluckData[$salaryScale->$key] = "{$jobTitleName} - {$salaryScaleName}";
    }

    return $pluckData;
}



	
}

?>