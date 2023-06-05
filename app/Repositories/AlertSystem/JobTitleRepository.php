<?php
namespace App\Repositories\AlertSystem;

use Auth;
use App\Exports\AlertSystem\ExportJobTitleListTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\BaseRepository;
use App\Models\AlertSystem\JobTitle;

class JobTitleRepository extends BaseRepository
{
     
    /**
     * @return string
     */
    public function model()
    {
        return JobTitle::class;
    }

    	public function create(array $input)
	{
		//$user = Auth::user();

		//if (! $user->can('recreational.create'))
		//{

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['name']=$input['name'];
		$data['department_id']=$input['department_id'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        return $item;
        
	}

	public function update(JobTitle $model, array $input)
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
		$data['name']=$input['name'];
		$data['department_id']=$input['department_id'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = 'id', $sort = 'asc', $trashed = false)
{
    $dataTableQuery = $this->model->query()
        ->select(['job_titles.id', 'job_titles.name as job_title_name', 'departments.department_name as department_name'])
        ->leftJoin('departments', 'departments.id', '=', 'job_titles.department_id');

    if (!empty($search)) {
        $search = '%' . strtolower($search) . '%' ;
        $dataTableQuery->where(function ($query) use ($search) {
            $query->where('id','LIKE',  $search )
                ->orWhere('job_title_name','LIKE',  $search )
                ->orWhere('department_name','LIKE',  $search );
        });
    }

    if (!empty($order_by)) {
        $dataTableQuery->orderBy($order_by, $sort);
    }

    return $dataTableQuery->get();
}



        public function getJobTitlesByDepartment($department_id)
        {
            $jobTitles = JobTitle::where('department_id', $department_id)->get(['id', 'name']);

            if ($jobTitles->isEmpty()) {
                return response()->json(['error' => 'No job titles found for the given department ID.']);
            }

            return response()->json(['data' => $jobTitles]);
        }




	   
    public function pluck($column = 'name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>