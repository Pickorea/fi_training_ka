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

	//   \Barryvdh\Debugbar\Facade::info('Vacancy getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()
						       ->select(['job_titles.id', 'job_titles.type']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
				       ->orWhere('type','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }

	

	
	
    // public function pluck($column = 'type', $key = 'id')
    // {
    //     return $this->model->query()
    //         ->orderBy($column)
    //         ->pluck($column, $key);
    // }
}

?>