<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\Vacancy;
use Auth;

class VacancyRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Vacancy::class;
    }

	public function create(array $input)
	{
		$data = [
			// 'type' => $input['type'],
			'department_id' => $input['department_id'],
			'job_title_id' => $input['job_title_id'],
		];
	
		$item = Vacancy::create($data);
	}
	

	public function update(Vacancy $model, array $input)
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
		$data=[];
		// $data['type']=$input['type'];
		$data['department_id']=$input['department_id'];
		$data['job_title_id']=$input['job_title_id'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
{
    $dataTableQuery = $this->model->query()
        ->join('departments', 'vacancies.department_id', '=', 'departments.id')
        ->join('job_titles', 'vacancies.job_title_id', '=', 'job_titles.id')
        ->join('vacancy_statuses', 'vacancies.id', '=', 'vacancy_statuses.vacancy_id')
        ->select('vacancies.id', 'departments.department_name', 'job_titles.name', 'vacancy_statuses.status');

    // Apply search criteria if provided
    if (!empty($search)) {
        $dataTableQuery->where(function ($query) use ($search) {
            $query->where('departments.department_name', 'like', '%' . $search . '%')
                  ->orWhere('job_titles.name', 'like', '%' . $search . '%')
                  ->orWhere('vacancy_statuses.status', 'like', '%' . $search . '%');
        });
    }

    // Apply order and sorting criteria if provided
    if (!empty($order_by)) {
        $dataTableQuery->orderBy($order_by, $sort);
    }
	// dd($dataTableQuery->get());

    return $dataTableQuery->get();
}

	

// public function pluck($column = 'type', $key = 'id')
// {
// 	return $this->model->query()
// 		->orderBy($column)
// 		->pluck($column, $key);
// }

	

	
	
}

?>