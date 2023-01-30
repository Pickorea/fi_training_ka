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

		//throw new GeneralException(__('exceptions-app.frontend.not_auth'));

		//}
		$data=[];
		$data['name']=$input['name'];
		$data['age']=$input['age'];
		$data['email']=$input['email'];
        $data['work_status_id']=$input['work_status_id'];
		$item=$this->model();
		$item=new $item($data);
		//$item->owner_organisation_id=$user->organisation_id;
        $item->save();
        
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
		$data=[];
		$data['name']=$input['name'];
		$data['age']=$input['age'];
		$data['email']=$input['email'];
        $data['work_status_id']=$input['work_status_id'];
		return $model->update($data);
	}

	public function getForDataTable($search = '', $order_by = '', $sort = 'asc', $trashed = false)
    {

	//   \Barryvdh\Debugbar\Facade::info('Employee getForDataTable : "' . $search . '"');
       // $user = Auth::user();
        $dataTableQuery = $this->model->query()
						->leftjoin('work_status','work_status.id', '=', 'employees.work_status_id')						
                       ->select(['employees.id', 'employees.name', 'employees.age', 'employees.email', 'work_status.work_status_name']);
         if (!empty($search)) {
            $search = '%' . strtolower($search) . '%' ;
            $dataTableQuery->where(function ($query) use ($search) {
                $query->where('id','ILIKE',  $search )
					->orWhere('name','ILIKE',  $search )
					->orWhere('age','ILIKE',  $search )
					->orWhere('email','ILIKE',  $search )
                    ->orWhere('work_status_name','ILIKE',  $search );
            });
        }


        if ($trashed == "true") {
            return $dataTableQuery->onlyTrashed();
        }
        return $dataTableQuery ;
    }
	   
    public function pluck($column = 'name', $key = 'id')
    {
        return $this->model->query()
            ->orderBy($column)
            ->pluck($column, $key);
    }
}

?>