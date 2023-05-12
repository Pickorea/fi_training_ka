<?php
namespace App\Repositories\AlertSystem;

use App\Repositories\BaseRepository;
use App\Models\AlertSystem\JobTitle;
use Auth;

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

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
    {

	//   \Barryvdh\Debugbar\Facade::info('JobTitle getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()
						       ->select(['job_titles.id', 'job_titles.name']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
				       ->orWhere('name','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }

// 	public function getJobTitlesByDepartment($department_id)
// {
//     if ($this->model instanceof Illuminate\Database\Eloquent\Model) {
//         return $this->model->query()
//             ->select('job_titles.id', 'job_titles.name', 'departments.department_name as department_name')
//             ->join('departments', 'departments.id', '=', 'job_titles.department_id')
//             ->where('department_id', $department_id)
//             ->pluck('name', 'id')
//             ->dd();
//     } else {
//         // do something else, like throw an exception or return an error message
//     }
// }

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